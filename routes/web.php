<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\Market\GuaranteeController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Customer\Profile\ProfileController;
use App\Http\Controllers\Admin\Market\ProductColorController;
use App\Http\Controllers\Customer\Profile\FavoriteController;
use App\Http\Controllers\Admin\Market\CategoryValueController;
use App\Http\Controllers\Customer\SalesProcess\CartController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Customer\SalesProcess\AddressController;
use App\Http\Controllers\Customer\SalesProcess\ProfileCompletionController;
use App\Http\Controllers\Customer\Profile\OrderController as ProfileOrderController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Customer\Market\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\SalesProcess\PaymentController as CustomerPaymentController;
use App\Http\Controllers\Customer\Profile\AddressController as ProfileAddressController;
use App\Http\Controllers\Customer\Profile\TicketController as ProfileTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('home');
    // Market
    Route::prefix('market')->name('market.')->group(function () {
        // Store
        Route::get('store', [StoreController::class, 'index'])->name('store.index');
        Route::get('store/{product}/add-to-store', [StoreController::class, 'addToStore'])->name('store.add-to-store');
        Route::post('store/{product}', [StoreController::class, 'store'])->name('store.store');
        Route::get('store/{product}/edit', [StoreController::class, 'edit'])->name('store.edit');
        Route::put('store/{product}', [StoreController::class, 'update'])->name('store.update');
        // Brand
        Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
        Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        Route::get('brands/{brand}/change-status', [BrandController::class, 'changeStatus'])->name('brands.change-status');
        // Category
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('categories/{category}/change-status', [CategoryController::class, 'changeStatus'])->name('categories.change-status');
        Route::get('categories/{category}/show-in-menu', [CategoryController::class, 'showInMenu'])->name('categories.show-in-menu');
        // Product
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('products/{product}/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
        Route::get('products/{product}/change-marketable', [ProductController::class, 'changeMarketable'])->name('products.change-marketable');
        // Product Color
        Route::get('products/{product}/colors', [ProductColorController::class, 'index'])->name('products.colors.index');
        Route::get('products/{product}/colors/create', [ProductColorController::class, 'create'])->name('products.colors.create');
        Route::post('products/{product}/colors', [ProductColorController::class, 'store'])->name('products.colors.store');
        Route::delete('products/{product}/colors/{color}', [ProductColorController::class, 'destroy'])->name('products.colors.destroy');
        // Product Guarantee
        Route::get('products/{product}/guarantees', [GuaranteeController::class, 'index'])->name('products.guarantees.index');
        Route::get('products/{product}/guarantees/create', [GuaranteeController::class, 'create'])->name('products.guarantees.create');
        Route::post('products/{product}/guarantees', [GuaranteeController::class, 'store'])->name('products.guarantees.store');
        Route::delete('products/{product}/guarantees/{guarantee}', [GuaranteeController::class, 'destroy'])->name('products.guarantees.destroy');

        // Product Gallery
        Route::get('products/{product}/gallery', [GalleryController::class, 'index'])->name('products.gallery.index');
        Route::get('products/{product}/gallery/create', [GalleryController::class, 'create'])->name('products.gallery.create');
        Route::post('products/{product}/gallery', [GalleryController::class, 'store'])->name('products.gallery.store');
        Route::delete('products/{product}/gallery/{image}', [GalleryController::class, 'destroy'])->name('products.gallery.destroy');
        // Property
        Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
        Route::get('properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
        // Property Value
        Route::get('properties/{property}/values', [CategoryValueController::class, 'index'])->name('properties.values.index');
        Route::get('properties/{property}/values/create', [CategoryValueController::class, 'create'])->name('properties.values.create');
        Route::post('properties/{property}/values', [CategoryValueController::class, 'store'])->name('properties.values.store');
        Route::get('properties/{property}/values/{value}/edit', [CategoryValueController::class, 'edit'])->name('properties.values.edit');
        Route::put('properties/{property}/values/{value}', [CategoryValueController::class, 'update'])->name('properties.values.update');
        Route::delete('properties/{property}/values/{value}', [CategoryValueController::class, 'destroy'])->name('properties.values.destroy');
        // Comment
        Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
        Route::get('comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
        Route::post('comments/{comment}/answer', [CommentController::class, 'answer'])->name('comments.answer');
        Route::get('comments/{comment}/change-approved', [CommentController::class, 'changeApproved'])->name('comments.change-approved');
        Route::get('comments/{comment}/change-status', [CommentController::class, 'changeStatus'])->name('comments.change-status');
        // Order
        Route::get('orders', [OrderController::class, 'all'])->name('orders.all');
        Route::get('orders/new', [OrderController::class, 'new'])->name('orders.new');
        Route::get('orders/sending', [OrderController::class, 'sending'])->name('orders.sending');
        Route::get('orders/unpaid', [OrderController::class, 'unpaid'])->name('orders.unpaid');
        Route::get('orders/canceled', [OrderController::class, 'canceled'])->name('orders.canceled');
        Route::get('orders/returned', [OrderController::class, 'returned'])->name('orders.returned');
        Route::get('orders/{order}/show', [OrderController::class, 'show'])->name('orders.show');
        Route::get('orders/{order}/change-send-status', [OrderController::class, 'changeSendStatus'])->name('orders.change-send-status');
        Route::get('orders/{order}/change-order-status', [OrderController::class, 'changeOrderStatus'])->name('orders.change-order-status');
        Route::get('orders/{order}/cancel-order', [OrderController::class, 'cancelOrder'])->name('orders.cancel-order');
        Route::get('orders/{order}/detail', [OrderController::class, 'detail'])->name('orders.detail');
        // Payment
        Route::get('payments', [PaymentController::class, 'all'])->name('payments.all');
        Route::get('payments/online', [PaymentController::class, 'online'])->name('payments.online');
        Route::get('payments/offline', [PaymentController::class, 'offline'])->name('payments.offline');
        Route::get('payments/cash', [PaymentController::class, 'cash'])->name('payments.cash');
        Route::get('payments/{payment}/returned', [PaymentController::class, 'returned'])->name('payments.returned');
        Route::get('payments/{payment}/canceled', [PaymentController::class, 'canceled'])->name('payments.canceled');
        Route::get('payments/{payment}/show', [PaymentController::class, 'show'])->name('payments.show');
        // Discount
        Route::prefix('discounts')->name('discounts.')->group(function () {
            // Coupon
            Route::get('coupons', [DiscountController::class, 'coupons'])->name('coupons.index');
            Route::get('coupons/create', [DiscountController::class, 'couponCreate'])->name('coupons.create');
            Route::post('coupons', [DiscountController::class, 'couponStore'])->name('coupons.store');
            Route::get('coupons/{coupon}/edit', [DiscountController::class, 'couponEdit'])->name('coupons.edit');
            Route::put('coupons/{coupon}', [DiscountController::class, 'couponUpdate'])->name('coupons.update');
            Route::delete('coupons/{coupon}', [DiscountController::class, 'couponDestroy'])->name('coupons.destroy');
            // Common Discount
            Route::get('common-discounts', [DiscountController::class, 'commonDiscounts'])->name('common-discounts.index');
            Route::get('common-discounts/create', [DiscountController::class, 'commonDiscountCreate'])->name('common-discounts.create');
            Route::post('common-discounts', [DiscountController::class, 'commonDiscountStore'])->name('common-discounts.store');
            Route::get('common-discounts/{commonDiscount}/edit', [DiscountController::class, 'commonDiscountEdit'])->name('common-discounts.edit');
            Route::put('common-discounts/{commonDiscount}', [DiscountController::class, 'commonDiscountUpdate'])->name('common-discounts.update');
            Route::delete('common-discounts/{commonDiscount}', [DiscountController::class, 'commonDiscountDestroy'])->name('common-discounts.destroy');
            // Amazing Sale
            Route::get('amazing-sale', [DiscountController::class, 'amazingSale'])->name('amazing-sale.index');
            Route::get('amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('amazing-sale.create');
            Route::post('amazing-sale', [DiscountController::class, 'amazingSaleStore'])->name('amazing-sale.store');
            Route::get('amazing-sale/{amazingSale}/edit', [DiscountController::class, 'amazingSaleEdit'])->name('amazing-sale.edit');
            Route::put('amazing-sale/{amazingSale}', [DiscountController::class, 'amazingSaleUpdate'])->name('amazing-sale.update');
            Route::delete('amazing-sale/{amazingSale}', [DiscountController::class, 'amazingSaleDestroy'])->name('amazing-sale.destroy');
        });
        // Delivery
        Route::get('delivery', [DeliveryController::class, 'index'])->name('delivery.index');
        Route::get('delivery/create', [DeliveryController::class, 'create'])->name('delivery.create');
        Route::post('delivery', [DeliveryController::class, 'store'])->name('delivery.store');
        Route::get('delivery/{delivery}/edit', [DeliveryController::class, 'edit'])->name('delivery.edit');
        Route::put('delivery/{delivery}', [DeliveryController::class, 'update'])->name('delivery.update');
        Route::delete('delivery/{delivery}', [DeliveryController::class, 'destroy'])->name('delivery.destroy');
        Route::get('delivery/{delivery}/change-status', [DeliveryController::class, 'changeStatus'])->name('delivery.change-status');
    });
    // Content
    Route::prefix('content')->name('content.')->group(function () {
        // Menu
        Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
        Route::get('menus/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('menus', [MenuController::class, 'store'])->name('menus.store');
        Route::get('menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
        Route::put('menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::get('menus/{menu}/change-status', [MenuController::class, 'changeStatus'])->name('menus.change-status');
        // Page
        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
        Route::get('pages/{page}/change-status', [PageController::class, 'changeStatus'])->name('pages.change-status');
        // Banner
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
        Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
        Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
        Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');
        Route::get('banners/{banner}/change-status', [BannerController::class, 'changeStatus'])->name('banners.change-status');
        // Category
        Route::get('categories', [ContentCategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [ContentCategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [ContentCategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{postCategory}/edit', [ContentCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{postCategory}', [ContentCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('categories/{postCategory}/change-status', [ContentCategoryController::class, 'changeStatus'])->name('categories.change-status');
        // Post
        Route::get('posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('posts/{post}/change-status', [PostController::class, 'changeStatus'])->name('posts.change-status');
        Route::get('posts/{post}/change-commentable', [PostController::class, 'changeCommentable'])->name('posts.change-commentable');
        // Comment
        Route::get('comments', [ContentCommentController::class, 'index'])->name('comments.index');
        Route::get('comments/{comment}', [ContentCommentController::class, 'show'])->name('comments.show');
        Route::post('comments/{comment}/answer', [ContentCommentController::class, 'answer'])->name('comments.answer');
        Route::get('comments/{comment}/change-approved', [ContentCommentController::class, 'changeApproved'])->name('comments.change-approved');
        Route::get('comments/{comment}/change-status', [ContentCommentController::class, 'changeStatus'])->name('comments.change-status');
        // faqs
        Route::get('faqs', [FAQController::class, 'index'])->name('faqs.index');
        Route::get('faqs/create', [FAQController::class, 'create'])->name('faqs.create');
        Route::post('faqs', [FAQController::class, 'store'])->name('faqs.store');
        Route::get('faqs/{faq}/edit', [FAQController::class, 'edit'])->name('faqs.edit');
        Route::put('faqs/{faq}', [FAQController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/{faq}', [FAQController::class, 'destroy'])->name('faqs.destroy');
        Route::get('faqs/{faq}/change-status', [FAQController::class, 'changeStatus'])->name('faqs.change-status');
    });
    // User
    Route::prefix('users')->name('users.')->group(function () {
        // Admin User
        Route::get('admin-users', [AdminUserController::class, 'index'])->name('admin-users.index');
        Route::get('admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');
        Route::post('admin-users', [AdminUserController::class, 'store'])->name('admin-users.store');
        Route::get('admin-users/{admin}/edit', [AdminUserController::class, 'edit'])->name('admin-users.edit');
        Route::put('admin-users/{admin}', [AdminUserController::class, 'update'])->name('admin-users.update');
        Route::delete('admin-users/{admin}', [AdminUserController::class, 'destroy'])->name('admin-users.destroy');
        Route::get('admin-users/{admin}/change-status', [AdminUserController::class, 'changeStatus'])->name('admin-users.change-status');
        Route::get('admin-users/{admin}/change-activation', [AdminUserController::class, 'changeActivation'])->name('admin-users.change-activation');
        Route::get('admin-users/{admin}/roles', [AdminUserController::class, 'roles'])->name('admin-users.roles');
        Route::post('admin-users/{admin}/roles', [AdminUserController::class, 'rolesStore'])->name('admin-users.roles-store');
        Route::get('admin-users/{admin}/permissions', [AdminUserController::class, 'permissions'])->name('admin-users.permissions');
        Route::post('admin-users/{admin}/permissions', [AdminUserController::class, 'permissionsStore'])->name('admin-users.permissions-store');
        // Customer
        Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::get('customers/{customer}/change-status', [CustomerController::class, 'changeStatus'])->name('customers.change-status');
        Route::get('customers/{customer}/change-activation', [CustomerController::class, 'changeActivation'])->name('customers.change-activation');
        // Role
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        Route::get('roles/{role}/change-status', [RoleController::class, 'changeStatus'])->name('roles.change-status');
        Route::get('roles/{role}/permission-form', [RoleController::class, 'permissionForm'])->name('roles.permission-form');
        Route::put('roles/{role}/permission-update', [RoleController::class, 'permissionUpdate'])->name('roles.permission-update');
        // Permission
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
        Route::get('permissions/{permission}/change-status', [PermissionController::class, 'changeStatus'])->name('permissions.change-status');
    });
    // Ticket
    Route::prefix('tickets')->name('tickets.')->group(function () {
        // Ticket Category
        Route::get('categories', [TicketCategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [TicketCategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [TicketCategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [TicketCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [TicketCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [TicketCategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('categories/{category}/change-status', [TicketCategoryController::class, 'changeStatus'])->name('categories.change-status');
        // Ticket Priority
        Route::get('priorities', [TicketPriorityController::class, 'index'])->name('priorities.index');
        Route::get('priorities/create', [TicketPriorityController::class, 'create'])->name('priorities.create');
        Route::post('priorities', [TicketPriorityController::class, 'store'])->name('priorities.store');
        Route::get('priorities/{priority}/edit', [TicketPriorityController::class, 'edit'])->name('priorities.edit');
        Route::put('priorities/{priority}', [TicketPriorityController::class, 'update'])->name('priorities.update');
        Route::delete('priorities/{priority}', [TicketPriorityController::class, 'destroy'])->name('priorities.destroy');
        Route::get('priorities/{priority}/change-status', [TicketPriorityController::class, 'changeStatus'])->name('priorities.change-status');
        // Ticket Admin
        Route::get('admins', [TicketAdminController::class, 'index'])->name('admins.index');
        Route::get('admins/{admin}/set', [TicketAdminController::class, 'setAdmin'])->name('admins.set');
        // Ticket
        Route::get('/', [TicketController::class, 'all'])->name('all');
        Route::get('new-tickets', [TicketController::class, 'newTickets'])->name('new-tickets');
        Route::get('open-tickets', [TicketController::class, 'openTickets'])->name('open-tickets');
        Route::get('close-tickets', [TicketController::class, 'closeTickets'])->name('close-tickets');
        Route::get('{ticket}', [TicketController::class, 'show'])->name('show');
        Route::post('{ticket}/answer', [TicketController::class, 'answer'])->name('answer');
        Route::get('{ticket}/change', [TicketController::class, 'change'])->name('change');
    });
    // Notify
    Route::prefix('notify')->name('notify.')->group(function () {
        // SMS
        Route::get('sms', [SMSController::class, 'index'])->name('sms.index');
        Route::get('sms/create', [SMSController::class, 'create'])->name('sms.create');
        Route::post('sms', [SMSController::class, 'store'])->name('sms.store');
        Route::get('sms/{sms}/edit', [SMSController::class, 'edit'])->name('sms.edit');
        Route::put('sms/{sms}', [SMSController::class, 'update'])->name('sms.update');
        Route::delete('sms/{sms}', [SMSController::class, 'destroy'])->name('sms.destroy');
        Route::get('sms/{sms}/change-status', [SMSController::class, 'changeStatus'])->name('sms.change-status');
        // Email
        Route::get('email', [EmailController::class, 'index'])->name('email.index');
        Route::get('email/create', [EmailController::class, 'create'])->name('email.create');
        Route::post('email', [EmailController::class, 'store'])->name('email.store');
        Route::get('email/{email}/edit', [EmailController::class, 'edit'])->name('email.edit');
        Route::put('email/{email}', [EmailController::class, 'update'])->name('email.update');
        Route::delete('email/{email}', [EmailController::class, 'destroy'])->name('email.destroy');
        Route::get('email/{email}/change-status', [EmailController::class, 'changeStatus'])->name('email.change-status');
        // Email File
        Route::get('email-files/{email}', [EmailFileController::class, 'index'])->name('email-files.index');
        Route::get('email-files/{email}/create', [EmailFileController::class, 'create'])->name('email-files.create');
        Route::post('email-files/{email}', [EmailFileController::class, 'store'])->name('email-files.store');
        Route::get('email-files/{file}/edit', [EmailFileController::class, 'edit'])->name('email-files.edit');
        Route::put('email-files/{file}', [EmailFileController::class, 'update'])->name('email-files.update');
        Route::delete('email-files/{file}', [EmailFileController::class, 'destroy'])->name('email-files.destroy');
        Route::get('email-files/{file}/change-status', [EmailFileController::class, 'changeStatus'])->name('email-files.change-status');
    });
    // Setting
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('setting/{setting}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('setting/{setting}', [SettingController::class, 'update'])->name('setting.update');

    Route::post('notification/read-all', [NotificationController::class, 'readAll'])->name('notification.read-all');
});

Route::name('auth.customer.')->group(function (){
    Route::get('login-register', [LoginRegisterController::class, 'loginRegisterForm'])->name('login-register-form');
    Route::middleware('throttle:customer-login-register-limiter')->post('login-register', [LoginRegisterController::class, 'loginRegister'])->name('login-register');
    Route::get('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirmForm'])->name('login-confirm-form');
    Route::middleware('throttle:customer-login-confirm-limiter')->post('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirm'])->name('login-confirm');
    Route::middleware('throttle:customer-login-resend-otp-limiter')->get('login-resend-otp/{token}', [LoginRegisterController::class, 'loginResendOtp'])->name('login-resend-otp');
    Route::get('logout', [LoginRegisterController::class, 'logout'])->name('logout');
});

Route::get('/', [HomeController::class, 'home'])->name('customer.home');
Route::get('products', [HomeController::class, 'products'])->name('customer.products');
Route::get('show-all', [HomeController::class, 'showAll'])->name('customer.show-all');
Route::get('category/{category}/products', [HomeController::class, 'categoryProducts'])->name('customer.category.products');

Route::name('customer.sales-process.')->group(function (){
    // Cart
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::post('cart', [CartController::class, 'updateCart'])->name('update-cart');
    Route::post('add-to-cart/{product:slug}', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('remove-from-cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
    Route::middleware('profile.completion')->group(function (){
        // Address
        Route::get('address-and-delivery', [AddressController::class, 'addressAndDelivery'])->name('address-and-delivery');
        Route::post('add-address', [AddressController::class, 'addAddress'])->name('add-address');
        Route::put('update-address/{address}', [AddressController::class, 'updateAddress'])->name('update-address');
        Route::get('get-cities/{province}', [AddressController::class, 'getCities'])->name('get-cities');
        Route::post('choose-address-and-delivery', [AddressController::class, 'chooseAddressAndDelivery'])->name('choose-address-and-delivery');
        // Payment
        Route::get('payment', [CustomerPaymentController::class, 'payment'])->name('payment');
        Route::post('coupon-discount', [CustomerPaymentController::class, 'couponDiscount'])->name('coupon-discount');
        Route::post('payment-submit', [CustomerPaymentController::class, 'paymentSubmit'])->name('payment-submit');
        Route::any('payment-callback/{order}/{onlinePayment}', [CustomerPaymentController::class, 'paymentCallback'])->name('payment-callback');
    });
    // Profile Completion
    Route::get('profile-completion', [ProfileCompletionController::class, 'profileCompletion'])->name('profile-completion');
    Route::post('profile-completion', [ProfileCompletionController::class, 'updateProfile'])->name('update-profile');
});
Route::prefix('market')->name('customer.market.')->group(function (){
    Route::get('product/{product}', [CustomerProductController::class, 'product'])->name('product');
    Route::get('product/{product}/add-comment', [CustomerProductController::class, 'addComment'])->name('product.add-comment');
    Route::get('product/{product}/add-to-favorites', [CustomerProductController::class, 'addToFavorites'])->name('product.add-to-favorites');
});

Route::prefix('profile')->name('customer.profile.')->group(function (){
    Route::get('orders', [ProfileOrderController::class, 'index'])->name('orders');
    Route::get('my-favorites', [FavoriteController::class, 'index'])->name('my-favorites');
    Route::get('my-favorites/delete/{product}', [FavoriteController::class, 'delete'])->name('my-favorites.delete');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::get('my-addresses', [ProfileAddressController::class, 'index'])->name('my-addresses');
    Route::get('my-tickets', [ProfileTicketController::class, 'index'])->name('my-tickets');
    Route::get('my-tickets/create', [ProfileTicketController::class, 'create'])->name('my-tickets.create');
    Route::post('my-tickets/store', [ProfileTicketController::class, 'store'])->name('my-tickets.store');
    Route::get('my-tickets/{ticket}', [ProfileTicketController::class, 'show'])->name('my-tickets.show');
    Route::post('my-tickets/{ticket}/answer', [ProfileTicketController::class, 'answer'])->name('my-tickets.answer');
    Route::get('my-tickets/{ticket}/change', [ProfileTicketController::class, 'change'])->name('my-tickets.change');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});
