<?php

namespace App\Http\Requests\Customer\SalesProcess;

use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|min:1|max:300',
            'postal_code' => ['nullable', new PostalCode()],
            'no' => 'required',
            'unit' => 'required',
            'receiver' => 'sometimes',
            'recipient_first_name' => 'required_with:receiver,on', //  در صورتی که تیک receiver فعال بود وارد کردنش الزامی است
            'recipient_last_name' => 'required_with:receiver,on', //  در صورتی که تیک receiver فعال بود وارد کردنش الزامی است
            'mobile' => 'required_with:receiver,on', //  در صورتی که تیک receiver فعال بود وارد کردنش الزامی است
        ];
    }

    public function attributes()
    {
        return [
            'unit' => 'واحد',
            'mobile' => 'موبایل گیرنده',
        ];
    }
}
