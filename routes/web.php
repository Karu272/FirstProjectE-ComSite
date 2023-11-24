<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\NewsletterController;
use App\Models\Category;
use App\Http\Controllers\CaptchaValidationController;

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // All the admin routes will be defined here:-

    Route::match(['get', 'post'], '/', 'AdminController@login');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('logout', 'AdminController@logout');
        Route::get('settings', 'AdminController@settings');
        Route::post('check-current-pwd', 'AdminController@chkCurrentPassword');
        Route::post('update-current-pwd', 'AdminController@updateCurrentPassword');
        Route::match(['get', 'post'], '/update-admin-details', 'AdminController@updateAdminDetails');
        // Sections
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        // Brand
        Route::get('brands', 'BrandController@brands');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        // Categories
        Route::get('categories', 'CategoryController@categories');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        // Append Categories
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        // Category Image
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
        // Products
        Route::get('products', 'ProductsController@products');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');
        // Delete product Image/video
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductsController@deleteProductVideo');
        // Atttributes
        Route::match(['get', 'post'], '/add-attributes/{id?}', 'ProductsController@addAttributes');
        Route::post('edit-attributes/{id}', 'ProductsController@editAttributes');
        Route::get('delete-attribute/{id}', 'ProductsController@deleteAttribute');
        // Images
        Route::match(['get', 'post'], 'add-images/{id?}', 'ProductsController@addImages');
        Route::get('delete-image/{id}', 'ProductsController@deleteImage');
        // Coupons
        Route::get('coupons', 'CouponsController@coupons');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::match(['get', 'post'], 'add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
        Route::get('delete-coupon/{id}', 'CouponsController@deleteCoupon');
        // Orders
        Route::get('orders', 'OrdersController@orders');
        Route::get('orders/{id}','OrdersController@orderDetails');
        Route::post('update-order-status','OrdersController@updateOrderStatus');
        Route::get('view-order-invoice/{id}','OrdersController@viewOrderInvoice');
		Route::get('print-pdf-invoice/{id}','OrdersController@printPDFInvoice');
        Route::get('delete-orderitem/{id}','OrdersController@deleteOrderItem');
        // Shipping charges
        Route::get('view-shipping-charges','ShippingController@viewShippingCharges');
        Route::match(['get', 'post'], 'edit-shipping-charges/{id}', 'ShippingController@addEditShipping');
        Route::post('update-shipping-status', 'ShippingController@updateShippingStatus');


        // Index top Bruce Banner
        Route::get('banners', 'BannersController@banners');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannersController@addEditBanner');
        Route::post('update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannersController@deleteBanner');
        // Index page video img
        Route::get('indexPageVideoImg', 'IndexPageVideoImgController@indexPageVideoImg');
        Route::match(['get', 'post'], 'add-edit-indexPageVideoImg/{id?}', 'IndexPageVideoImgController@addEditIndexPageVideoImg');
        Route::post('update-videoImg-status', 'IndexPageVideoImgController@updateVideoImgStatus');
        Route::get('delete-videoImg/{id}', 'IndexPageVideoImgController@deleteVideoImg');
        // Index bottom left img
        Route::get('bottomLeftImg', 'IndexBottomLeftController@bottomLeftImg');
        Route::match(['get', 'post'], 'add-edit-bottomLeftImg/{id?}', 'IndexBottomLeftController@addEditBottomLeftImg');
        Route::post('update-bottomLeftImg-status', 'IndexBottomLeftController@updateBottomLeftImageStatus');
        Route::get('delete-bottomLeftImg/{id}', 'IndexBottomLeftController@deleteBottomLeftImg');
        // Index bottom right img
        Route::get('bottomRImg', 'IndexBottomRController@bottomRImg');
        Route::match(['get', 'post'], 'add-edit-bottomRightImg/{id?}', 'IndexBottomRController@addEditBottomRImg');
        Route::post('update-bottomRightImg-status', 'IndexBottomRController@updateBottomRImgStatus');
        Route::get('delete-bottomRightImg/{id}', 'IndexBottomRController@deleteBottomRImg');
        // DropDown Img
        Route::get('ddImgPage', 'ddImgController@ddImg');
        Route::match(['get', 'post'], 'add-edit-ddImg/{id?}', 'ddImgController@addEditddImg');
        Route::post('update-ddImg-status', 'ddImgController@updateddImgStatus');
        Route::get('delete-ddImg/{id}', 'ddImgController@deleteddImg');
        // Carusel images upload
        Route::get('caruselImgPage', 'CaruselController@carusel');
        Route::match(['get', 'post'], 'add-edit-carusel/{id?}', 'CaruselController@addEditCarusel');
        Route::post('update-carusel-status', 'CaruselController@updateCaruselStatus');
        Route::get('delete-carusel/{id}', 'CaruselController@deleteCarusel');
        // Information
        Route::get('infoPage', 'InformationController@information');
        Route::match(['get', 'post'], 'add-edit-info/{id?}', 'InformationController@addEditInfo');
        // FAQ
        Route::get('faqPage', 'InformationController@faq');
        Route::match(['get', 'post'], 'add-edit-faq/{id?}', 'InformationController@addEditFaq');
        Route::get('delete-faq/{id}', 'InformationController@deleteFaq');
        // Listning page left/right Banner
        //left
        Route::get('listleftPage', 'BannersController@listleft');
        Route::match(['get', 'post'], 'add-edit-listleft/{id?}', 'BannersController@addEditListleft');
        Route::post('update-listleft-status', 'BannersController@updatelistleftStatus');
        Route::get('delete-listleft/{id}', 'BannersController@deleteListleft');
        //right
        Route::get('listrightPage', 'BannersController@listright');
        Route::match(['get', 'post'], 'add-edit-listright/{id?}', 'BannersController@addEditListright');
        Route::post('update-listright-status', 'BannersController@updatelistrightStatus');
        Route::get('delete-listright/{id}', 'BannersController@deleteListright');
        //end listing page left/right Banner
        // review
        Route::get('reviewPage', 'InformationController@review');
        Route::post('update-review-status', 'InformationController@updateReviewStatus');
        Route::get('delete-review/{id}', 'InformationController@deleteReview');
        // captcha
        Route::get('contact-form-captcha', [CaptchaValidationController::class, 'index']);
        Route::post('captcha-validation', [CaptchaValidationController::class, 'capthcaFormValidate']);
        Route::get('reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);
    });
});


Route::namespace('App\Http\Controllers\Front')->group(function () {
    // Homae page route
    Route::get('/', 'IndexController@index');

    // Get Category URL's
    $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($catUrls as $url) {
        // Category route
        Route::get('/' . $url, 'ProductsController@listing');
    }
    // Product detail route
    Route::get('/product/{id}', 'ProductsController@details');
    // Add to Cart
    Route::post('/add-to-cart', 'ProductsController@addtocart');
    // shopping cart route
    Route::get('/cart', 'ProductsController@cart');
    // Update Cart quantity
    Route::post('/update-cart-item-qty', 'ProductsController@updateCartItemQty');
    // Delete item from cart
    Route::post('/delete-cart-item', 'ProductsController@deleteCartItem');
    // Login / register page
    Route::get('/login-register', ['as' => 'login', 'uses' => 'UsersController@loginRegister']);
    // Login user
    Route::post('/login', 'UsersController@loginUser');
    // Register user
    Route::post('/register', 'UsersController@registerUser');
    // Check email if it already exist error msg
    Route::match(['get', 'post'], '/check-email', 'UsersController@checkEmail');
    // Logout user
    Route::get('/logout', 'UsersController@logoutUser');
    // Confirm the user account
    Route::match(['get', 'post'], '/confirm/{code}', 'UsersController@confirmAccount');
    // Forgot Password
    Route::match(['GET', 'POST'], '/forgot-password', 'UsersController@forgotPassword');
    // About us page
    Route::get('/aboutUs', 'AboutUsController@aboutUs');
    Route::get('/contactUs', 'AboutUsController@contactUs');
    // FAQ
    Route::get('/faq', 'AboutUsController@faq');
    // newsletter
    Route::get('/newsletter', [NewsletterController::class, 'create']);
    Route::post('/newsletter', [NewsletterController::class, 'store']);
    // Rewview
    Route::post('/review', 'ProductsController@review');

    //Protect user pages, checkout payment etc
    Route::group(['middleware' => ['auth']], function () {
        // Users Account
        Route::match(['GET', 'POST'], '/account', 'UsersController@account');

        // Users Orders
        Route::get('/orders', 'OrdersController@orders');

        // User Order Details
        Route::get('/orders/{id}', 'OrdersController@orderDetails');

        // Check User Password
        Route::post('/check-user-pwd', 'UsersController@chkUserPassword');

        // Update User Password
        Route::post('/update-user-pwd', 'UsersController@updateUserPassword');

        // Apply Coupon
        Route::post('/apply-coupon', 'ProductsController@applyCoupon');

        // Checkout
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');

        // Add/Edit Delivery Address
        Route::match(['GET', 'POST'], '/add-edit-delivery-address/{id?}', 'ProductsController@addEditDeliveryAddress');

        // Delete Delivery Address
        Route::get('/delete-delivery-address/{id}', 'ProductsController@deleteDeliveryAddress');

        // Thanks
        Route::get('/thanks', 'ProductsController@thanks');

        // Paypal
        Route::get('/paypal', 'PaypalController@paypal');

        // Paypal success
        Route::get('/paypal/success', 'PaypalController@success');

        // Paypal fail
        Route::get('/paypal/fail', 'PaypalController@fail');

        // Paypal IPN
        Route::post('/paypal/ipn', 'PaypalController@ipn');


    });
});
