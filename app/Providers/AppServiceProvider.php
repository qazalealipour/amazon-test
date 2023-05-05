<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Content\Comment;
use App\Models\Content\Menu;
use App\Models\Market\CartItem;
use App\Models\Market\ProductCategory;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::loginUsingId(1);

        Paginator::useBootstrapFive();

        $unseenComments = Comment::where('seen', '=', 0)->orderByDesc('created_at')->cursor();
        $notifications = Notification::whereNull('read_at')->orderByDesc('created_at')->cursor();
        $productCategories = ProductCategory::whereNull('parent_id')->cursor();
        $setting = Setting::find(1);
        $menus = Menu::whereNull('parent_id')->cursor();
        view()->composer('customer.layouts.header', function ($view) {
            if (Auth::check()) {
                $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
                $view->with('cartItems', $cartItems);
            }
        });
        View::share([
            'unseenComments' => $unseenComments,
            'notifications' => $notifications,
            'productCategories' => $productCategories,
            'setting' => $setting,
            'menus' => $menus
        ]);
    }
}
