<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SMSService;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        // check id is email or not
        if (filter_var($inputs['id'], FILTER_VALIDATE_EMAIL)) {
            $type = 1; // 1 => email
            $user = User::where('email', '=', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['email'] = $inputs['id'];
            }
        } elseif (preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])) {
            $type = 0; // 0 => mobile
            // All Mobile Numbers are in format 9** *** ** **
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', '=', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['mobile'] = $inputs['id'];
            }
        } else {
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => $errorText]);
        }

        if (empty($user)) {
            $newUser['password'] = '98355154';
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

        // create OTP code
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $inputs['id'],
            'type' => $type,
        ];
        $otp = Otp::create($otpInputs);

        // send sms or email
        if ($type == 0) {
            // send sms
            $smsService = new SMSService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون \n کد تایید : " . $otpCode);
            $smsService->setIsFlash(true);

            $messageService = new MessageService($smsService);
        } elseif ($type == 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => 'کد فعال سازی شما : ' . $otpCode,
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($inputs['id']);

            $messageService = new MessageService($emailService);
        }
        $messageService->send();
        return redirect()->route('auth.customer.login-confirm-form', [$token]);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token', '=', $token)->first();
        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => 'آدرس وارد شده نامعتبر می باشد']);
        }
        return view('customer.auth.login-confirm', compact('token', 'otp'));
    }

    public function loginConfirm($token, LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        $otpCode = Otp::where('token', '=', $token)->where('used', '=', 0)->where('created_at', '>=', Carbon::now()->subMinute(2)->toDateTimeString())->first();
        if (empty($otpCode)) {
            return redirect()->route('auth.customer.login-register-form', $token)->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }

        // if otp not match
        if ($inputs['otp'] !== $otpCode->otp_code) {
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['otp' => 'کد وارد شده صحیح نمیباشد']);
        }
        // if everything is ok
        $otpCode->update([
            'used' => 1,
        ]);
        $user = $otpCode->user()->first();
        if ($otpCode->type == 0 && empty($user->mobile_verified_at)) {
            $user->update([
                'mobile_verified_at' => Carbon::now(),
            ]);
        } elseif ($otpCode->type == 1 && empty($user->email_verified_at)) {
            $user->update([
                'email_verified_at' => Carbon::now(),
            ]);
        }
        Auth::login($user);
        return redirect()->route('customer.home');
    }

    public function loginResendOtp($token)
    {
        $otpCode = Otp::where('token', '=', $token)->where('created_at', '<=', Carbon::now()->subMinute(2)->toDateTimeString())->first();
        if (empty($otpCode)) {
            return redirect()->route('auth.customer.login-register-form', $token)->withErrors(['id' => 'آدرس وارد شده نامعتبر میباشد']);
        }
        $user = $otpCode->user()->first();
        // create OTP code
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $otpCode->login_id,
            'type' => $otpCode->type,
        ];
        $otp = Otp::create($otpInputs);

        // send sms or email
        if ($otpCode->type == 0) {
            // send sms
            $smsService = new SMSService();
            $smsService->setFrom(Config::get('sms.otp_from'));
            $smsService->setTo(['0' . $user->mobile]);
            $smsService->setText("مجموعه آمازون \n کد تایید : " . $otpCode);
            $smsService->setIsFlash(true);

            $messageService = new MessageService($smsService);
        } elseif ($otpCode->type == 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعال سازی',
                'body' => 'کد فعال سازی شما : ' . $otpCode,
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@example.com', 'example');
            $emailService->setSubject('کد احراز هویت');
            $emailService->setTo($otpCode->login_id);

            $messageService = new MessageService($emailService);
        }
        $messageService->send();
        return redirect()->route('auth.customer.login-confirm-form', [$token]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
