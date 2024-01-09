<?php

use App\Http\Controllers\ADMIN\BlogController;
use App\Http\Controllers\BlogCategoriesController;
use App\Http\Controllers\DeliveryOptionsController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\ServicesController;
use App\Models\DeliveryOptions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADMIN\{AdminViewController, AdminController,PageController,ProductCategoryController,ProductSubCategoryController,UsersController,VendorController,EmailIntegrationsController,ProductController,SettingController,TestimonialController,DiscountCouponController,OrderController,HomeContentController,MailController,LocaleFileController};
use App\Http\Controllers\Frontend\{CouponsController,HomeController,ProductController as FrontendProductController, HomeViewController,UserController,CartController,CommentController,SocialLoginController};
use App\Http\Controllers\Payment\{CheckoutController,PayPalPaymentController,StripePaymentController,RazorpayController};
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Admin Routes Start */
Route::group(['prefix' => 'admin'], function () {
    Route::post('/post-sign-in', [AdminController::class, 'login'])->name('admin.post-sign-in');
    
    Route::group(['middleware' => 'AdminViewUnAuth'], function () {
        Route::get('/', [AdminViewController::class, 'login_view'])->name('admin.login');
        Route::get('/login', [AdminViewController::class, 'login_view'])->name('admin.login');
    });
    Route::group(['middleware' => 'AdminViewAuth'], function () {
        Route::post('/upload_image', [AdminController::class, 'upload_image']);
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminViewController::class, 'dashboard_view'])->name('admin.dashboard');
        Route::get('/profile', [AdminViewController::class, 'profile_view'])->name('admin.profile');
        Route::get('/user-management', [AdminViewController::class, 'user_management_view'])->name('admin.user-management');
        Route::get('/contactus', [AdminViewController::class, 'contactus_view'])->name('admin.contactus.index');
        Route::post('/update_profile', [AdminController::class, 'update_profile'])->name('admin.update_profile');;
        /*
        Route::resource('blog-category', BlogCategoriesController::class)->names([
            'index' => 'admin.blog-category.index',
            'create'=>'admin.blog-category.create', 
            'store' => 'admin.blog-category.store',
            'edit'  => 'admin.blog-category.edit',
            'destroy' => 'admin.blog-category.destroy',
            
        ]);
        */
        Route::controller(BlogCategoriesController::class)->prefix('blog-category')->group(function(){
            Route::get('/index', 'index')->name('admin.blog-category.index');
            Route::post('/store', 'store')->name('admin.blog-category.store');
            Route::get('/create', 'create')->name('admin.blog-category.create');
          Route::get('edit/{id}', 'edit')->name('admin.blog-category.edit');
        Route::patch('update/{id}', 'update')->name('admin.blog-category.update');
            //Route::patch('update_status_featured/{id}', 'update_status_featured')->name('admin.product.featured_update');
            /*Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
            Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
            Route::get('/create-step-two/{id}', 'addProductStep2')->name('admin.product.create.step2');
            Route::get('/edit-step-two/{id}', 'editProductStep2')->name('admin.product.edit.step2');
            Route::post('/post-step-one', 'storeProductStep1')->name('admin.product.store.step1');
            Route::post('/post-step-two', 'storeProductStep2')->name('admin.product.store.step2'); */
            Route::delete('destroy/{id}', 'destroy')->name('admin.blog-category.destroy');
          //  Route::get('comment/{id}', 'comment_view')->name('admin.product.comment');
            //Route::get('review/{id}', 'review_view')->name('admin.product.review');
            
        }); 
        Route::resource('blog-category', BlogCategoriesController::class)->names([
            'show' => 'admin.blog-category.show',
            'create'=>'admin.blog-category.create', 
            //'index' => 'admin.blog-category.index',
          'edit'  => 'admin.blog-category.edit',
          
            ]);
            
            //for blogs
            Route::controller(BlogController::class)->prefix('blog')->group(function(){
                Route::get('/index', 'index')->name('admin.blog.index');
                Route::post('/store', 'store')->name('admin.blog.store');
                Route::get('/create', 'create')->name('admin.blog.create');
                Route::get('edit/{id}', 'edit')->name('admin.blog.edit');
            //Route::patch('update/{id}', 'update')->name('admin.blog-category.update');
                //Route::patch('update_status_featured/{id}', 'update_status_featured')->name('admin.product.featured_update');
                /*Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
                Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
                Route::get('/create-step-two/{id}', 'addProductStep2')->name('admin.product.create.step2');
                Route::get('/edit-step-two/{id}', 'editProductStep2')->name('admin.product.edit.step2');
                Route::post('/post-step-one', 'storeProductStep1')->name('admin.product.store.step1');
                Route::post('/post-step-two', 'storeProductStep2')->name('admin.product.store.step2'); */
                Route::delete('destroy/{id}', 'destroy')->name('admin.blog.destroy');
              //  Route::get('comment/{id}', 'comment_view')->name('admin.product.comment');
                //Route::get('review/{id}', 'review_view')->name('admin.product.review');
                
            }); 
       
        Route::resource('pages', PageController::class)->names([
            'index' => 'admin.pages.index',
            'create'=>'admin.pages.create', 
            'store' => 'admin.pages.store',
            'edit'  => 'admin.pages.edit',
            'destroy' => 'admin.pages.destroy',
        ]);
        Route::resource('product-category', ProductCategoryController::class)->names([
            'index' => 'admin.pro_category.index',
            'store' => 'admin.pro_category.store',
            'create' => 'admin.pro_category.create',
            'edit' => 'admin.pro_category.edit',
            'destroy' => 'admin.pro_category.destroy',
            'show' => 'admin.pro_category.show',
        ]);
        Route::resource('product-subcategory',ProductSubCategoryController::class)->names([
            'index' => 'admin.subcategory.index',
            'store' => 'admin.subcategory.store',
            'create' =>'admin.subcategory.create',
            'edit' => 'admin.subcategory.edit',
            'destroy' => 'admin.subcategory.destroy',
            'show' => 'admin.subcategory.show',
        ]);
        Route::resource('users',UsersController::class)->names([         
            'index' => 'admin.users.index',
            'store' => 'admin.users.store',
            'edit'  => 'admin.users.edit',
            'create' =>'admin.users.create',
            'destroy'=>'admin.users.destroy',
            'show'=>'admin.users.show',
        ]);
        Route::resource('vendor',VendorController::class)->names([
            'index' => 'admin.vendor.index',
            'store'=>'admin.vendor.store',
            'edit' => 'admin.vendor.edit',
            'destroy'=>'admin.vendor.destroy',
            'show'=>'admin.vendor.show',
            'create' =>'admin.vendor.create',
        ]);
        Route::get('/vender/terms-and-conditions', [VendorController::class, 'vendor_management'])->name('admin.vendor.term_and_conditions');
        Route::post('/editVendor', [VendorController::class, 'edit_save_vendor'])->name('admin.vendor.edit_save_vendor');

        Route::resource('email-integrations',EmailIntegrationsController::class)->names([
            'index' => 'admin.email_integrations.index',
            'store' => 'admin.email_integrations.store',
            'destroy'=>  'admin.email_integrations.destroy',
        ]);

        Route::controller(EmailIntegrationsController::class)->group(function(){
            Route::get('/emailList', 'SubscriberEmailList')->name('admin.emailList'); 
            Route::post('/email_autoresponder', 'email_autoresponder')->name('email_autoresponder'); 
            Route::post('/saveList', 'saveList')->name('admin.email_integrations.saveList');
        });

        
        Route::resource('testimonial',TestimonialController::class)->names([         
            'index' => 'admin.testimonial.index',
            'store' => 'admin.testimonial.store',
            'create' => 'admin.testimonial.create',
            'edit'   =>'admin.testimonial.edit',
            'destroy' => 'admin.testimonial.destroy',
            'show' => 'admin.testimonial.show',
        ]);
        Route::resource('discount-coupons',DiscountCouponController::class)->names([         
            'index' => 'admin.discount_coupon.index',
            'create'=> 'admin.discount_coupon.create',
            'store' =>   'admin.discount_coupon.store',
            'edit' =>   'admin.discount_coupon.edit',
            'destroy' => 'admin.discount_coupon.destroy',
            'show' => 'admin.discount_coupon.show',
        ]);

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
            Route::get('show/{id}', [OrderController::class, 'show'])->name('admin.order.show');
            Route::get('edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');
            Route::patch('update/{id}', [OrderController::class, 'update'])->name('admin.order.update');
            Route::delete('destroy/{id}',[OrderController::class, 'destroy'])->name('admin.order.destroy');

        });
        

       /* Route::resource('order',OrderController::class)->names([         
        //    'index' => 'admin.order.index',
            'create'=> 'admin.order.create',
            'store' =>   'admin.order.store',
            'edit' =>   'admin.order.edit',
            //'update' =>   'admin.order.update',
            'destroy' => 'admin.order.destroy',
            'show' => 'admin.order.show',
        ]); */

        Route::controller(LocaleFileController::class)->prefix('lang')->group(function(){
            Route::get('/', 'index')->name('admin.lang.index');
            Route::get('create/', 'create')->name('admin.lang.create');
            Route::post('/', 'store')->name('admin.lang.store');
            Route::post('store_master_file', 'store_master_file')->name('admin.lang.store_master_file');
            Route::post('store_message_file', 'store_message_file')->name('admin.lang.store_message_file');
            Route::post('store_page_title_file', 'store_page_title_file')->name('admin.lang.store_page_title_file');
            Route::post('store_fnt_message_file', 'store_fnt_message_file')->name('admin.lang.store_fnt_message_file');
            Route::get('edit/{id}', 'edit')->name('admin.lang.edit');
            Route::get('show/{lang}', 'show')->name('admin.lang.show');
            Route::patch('update/{id}', 'update')->name('admin.lang.update');
            Route::delete('destroy/{id}', 'destroy')->name('admin.lang.destroy');
        });

        Route::controller(HomeContentController::class)->prefix('home_content')->group(function(){
                Route::get('/', 'index')->name('admin.home_content.index');
                Route::get('create/', 'create')->name('admin.home_content.create');
                Route::post('/', 'store')->name('admin.home_content.store');
                Route::get('edit/{id}', 'edit')->name('admin.home_content.edit');
                Route::patch('update/{id}', 'update')->name('admin.home_content.update');
                Route::delete('destroy/{id}', 'destroy')->name('admin.home_content.destroy');
        });
        Route::controller(HomeContentController::class)->prefix('advertise')->group(function(){
                Route::get('/', 'advertise_view')->name('admin.advertise.index');
                Route::post('/',  'advertise_store')->name('admin.advertise.store');
                Route::get('create/', 'advertise_create')->name('admin.advertise.create');
                Route::get('edit/{id}', 'advertise_edit')->name('admin.advertise.edit');
        });

        Route::controller(ProductController::class)->prefix('product')->group(function(){
            Route::get('/', 'index')->name('admin.product.index');
            Route::get('edit/{id}', 'edit')->name('admin.product.edit');
            Route::patch('update/{id}', 'update')->name('admin.product.update');
            Route::patch('update_status_featured/{id}', 'update_status_featured')->name('admin.product.featured_update');
            Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
            Route::get('/create-step-one', 'addProductStep1')->name('admin.product.create.step1');
            Route::get('/create-step-two/{id}', 'addProductStep2')->name('admin.product.create.step2');
            Route::get('/edit-step-two/{id}', 'editProductStep2')->name('admin.product.edit.step2');
            Route::post('/post-step-one', 'storeProductStep1')->name('admin.product.store.step1');
            Route::post('/post-step-two', 'storeProductStep2')->name('admin.product.store.step2');
            Route::delete('destroy/{id}', 'destroy')->name('admin.product.destroy');
            Route::get('comment/{id}', 'comment_view')->name('admin.product.comment');
            Route::get('/deliveryoptions', 'index')->name('admin.product.delivery_options');
            Route::get('review/{id}', 'review_view')->name('admin.product.review');
        });
        Route::controller(DeliveryOptionsController::class)->prefix('product')->group(function(){
        Route::get('/deliveryoptions', 'index')->name('admin.product.delivery_options');

        });
        Route::controller(SettingController::class)->prefix('setting')->group(function(){
            Route::get('/website',  'website_setting_view')->name('admin.website-setting');
            Route::post('/add_update',  'store')->name('admin.setting.store');
            Route::post('/add_update_long_text',  'storelongtext')->name('admin.setting.storelongtext');
            Route::post('/add_update_lang',  'add_update_lang')->name('admin.setting.addupdatelang');
            Route::get('/menu',  'menu')->name('admin.menu');
            Route::get('/payment',  'payment_setting_view')->name('admin.payment-setting');
            Route::post('/add_update_banner',  'add_update_banner')->name('admin.setting.add_update_banner');
            Route::get('/manage_banner',  'manage_banner')->name('admin.setting.manage_banner');
            Route::get('/why_choose_us',  'why_choose_us_view')->name('admin.setting.why_choose_us');
            Route::get('/portal_revenue',  'portal_revenue_view')->name('admin.setting.revenue');
            Route::post('/email_templates_store', 'email_templates_stores')->name('admin.email_templates_store');
            Route::get('/email_template', 'email_templates')->name('admin.email_templates');
            Route::get('/social_login',  'social_login')->name('admin.setting.social-login');
            Route::post('/post-social',  'saveSociallogin')->name('admin.setting.post-social');

        });
        Route::post('/send_mail', [MailController::class, 'send_mail'])->name('admin.email.sendmail');
    });
});
/* Admin Routes  End */

/* Frontend Routes Start
Route::get('/', function () {
    return redirect(app()->getLocale());
});
*/
Route::get('/',  [HomeViewController::class,'index'])->name('frontend.home');

        Route::controller(HomeViewController::class)->group(function(){
          
            Route::get('/aboutus',  'aboutus_view')->name('frontend.about-us');
            Route::get('/privacy-policy',  'privacy_policy_view')->name('frontend.privacy-policy');
            Route::get('/terms-and-conditions',  'terms_and_conditions_view')->name('frontend.terms-and-conditions');
            Route::get('/contact-us', 'contactus_view')->name('frontend.contact-us');
            
        });

        
         //Product
        Route::controller(FrontendProductController::class)->prefix('product')->group(function(){
            Route::get('/{slug}', 'single_details')->name('frontend.product.single_details');
            Route::get('search', 'search')->name('frontend.product.search');
            Route::post('ajax_search_product', 'ajax_search_product')->name('frontend.product.postsearch');
        });

       /* Route::controller(ServicesController::class)->prefix('services')->group(function(){
            Route::get('/{slug}', 'single_details')->name('frontend.services.single_details');
            Route::get('search', 'search')->name('frontend.services.search');
            Route::post('ajax_search_product', 'ajax_search_product')->name('frontend.services.postsearch');
        });
      */

       
        Route::controller(HomeController::class)->group(function(){
            Route::post('/post-contact-us', 'postContactus')->name('frontend.post-contact-us');
            Route::get('/email-verification', 'emailVerify')->name('frontend.email-verify');
        });
        //User access without login
        Route::group(['middleware' => 'UserViewUnAuth'], function () {
            
            Route::controller(UserController::class)->group(function (){
                Route::post('/signup',  'signup')->name('frontend.usersignup');
                Route::post('/login',  'login')->name('frontend.userlogin');
                Route::post('/post-forgot',  'forgot_password')->name('frontend.post-forgot');
                Route::post('/post-reset-password',  'update_reset_password')->name('frontend.post-reset-password');
            });
        });

        //user access with login
        Route::group(['middleware' => 'UserViewAuth'], function () {
            Route::controller(UserController::class)->group(function (){
                Route::get('/logout',  'logout')->name('frontend.logout');
                Route::post('/update-profile',  'updateProfile')->name('frontend.update_profile');
                Route::post('/update-user-image',  'update_user_image')->name('frontend.update_user_image');
                Route::post('/change-password',  'change_password')->name('frontend.change-password');
            });
            //Checkout 
            Route::controller(CheckoutController::class)->group(function (){
                Route::post('/checkout', 'store')->name('frontend.checkout.store');
                Route::get('/transaction-success','transactionSuccess')->name('frontend.success.transaction');
               Route::get('/download-file','downlaodfile')->name('frontend.download-file');

                Route::get('/download-invoice','downlaod_invoice')->name('frontend.download-invoice');
                Route::get('/transaction-error','transactionError')->name('frontend.cancel.payment');
            });

            //coupon code apply
            Route::post('/post-coupon-code', [CouponsController::class, 'checkCouponCode'])->name('frontend.coupon.apply');
            Route::delete('/coupon-code', [CouponsController::class, 'destroy'])->name('frontend.coupon.destroy');

            /* paypal payment gateway*/
            Route::controller(PayPalPaymentController::class)->prefix('paypal')->group(function () {
                Route::get('cancel-payment', 'paymentCancel')->name('paypal.cancel.payment');
                Route::get('payment-success', 'paymentSuccess')->name('paypal.success.payment');
            });

            /*Stripe Payment */
            Route::controller(StripePaymentController::class)->prefix('stripe')->group(function(){
                Route::get('payment-success', 'success')->name('frontend.stripe.success');
                Route::post('handle-payment', 'handlePayment')->name('frontend.stripe.handle');
            });
            /*Stripe Payment*/

            // Product comment
            Route::controller(CommentController::class)->group(function (){
                Route::post('comment', 'store')->name('frontend.comment.store');
                Route::post('rating', 'rating_store')->name('admin.rating.store');
            });

             /*razorpay Payment */
            Route::controller(RazorpayController::class)
            ->prefix('razorpay')
            ->group(function () {
                Route::post('handle-payment', 'handlePayment')->name('razorpay.make.payment');
            });
            /*razorpay Payment*/
           
        });
        // Product comment
        
        Route::post('comment/ajax_search', [CommentController::class,'ajax_search_comments'])->name('frontend.comment.search');
        Route::post('rating/ajax_search', [CommentController::class,'ajax_search_rating'])->name('frontend.rating.search');
        Route::get('get_advertize', [HomeController::class,'get_advertize'])->name('frontend.get_advertize');
        Route::post('post_newsletter', [HomeController::class,'postNewsletter'])->name('frontend.post_newsletter');
//Social Login
Route::get('/google/redirect', function () { return Socialite::driver('google')->redirect(); })->name('frontend.login.google');
Route::get('/facebook/redirect', function () { return Socialite::driver('facebook')->redirect(); })->name('frontend.login.facebook');

Route::get('/google/callback', [SocialLoginController::class, 'googleCallback']);
Route::get('/facebook/callback', [SocialLoginController::class, 'facebookCallback']);
/* Frontend Routes End  */
Route::get('/download/{filename}', 'Product@download')->name('frontend.download');

Route::prefix('blogs')->group(function () {
    Route::get('/', [FrontendBlogController::class, 'index'])->name('frontend.blogs.index');
    Route::get('{slug}', [FrontendBlogController::class, 'show'])->name('frontend.blogs.show')->where('slug', '[a-zA-Z0-9-]+');
});
Route::controller(ServicesController::class)->prefix('services')->group(function(){
    Route::get('/{slug}', 'single_details')->name('frontend.services.single_details');
    Route::get('search', 'search')->name('frontend.services.search');
    Route::post('ajax_search_product', 'ajax_search_product')->name('frontend.services.postsearch');
});
Route::controller(HomeViewController::class)->group(function(){
    Route::get('/',  'index')->name('frontend.home');
    Route::get('/aboutus',  'aboutus_view')->name('frontend.about-us');
    Route::get('/privacy-policy',  'privacy_policy_view')->name('frontend.privacy-policy');
    Route::get('/terms-and-conditions',  'terms_and_conditions_view')->name('frontend.terms-and-conditions');
    Route::get('/contact-us', 'contactus_view')->name('frontend.contact-us');
    
});
 //User access without login
 Route::group(['middleware' => 'UserViewUnAuth'], function () {

    Route::controller(HomeViewController::class)->group(function (){
        Route::get('/sign-in', 'login_view')->name('frontend.sign-in');
        Route::get('/sign-up', 'register_view')->name('frontend.sign-up');
        Route::get('/forgot', 'forgot_view')->name('frontend.forgot');
        Route::get('/reset-password', 'reset_password_view')->name('frontend.reset-password');
    });
});

 // Cart
      
 Route::get('cart/',[ CartController::class,'index'])->name('frontend.cart.index');
 Route::group(['middleware' => 'UserViewAuth'], function () {
     Route::controller(HomeViewController::class)->group(function (){
         Route::get('/my-profile', 'profile_view')->name('frontend.profile');
         Route::get('wishlist', 'wishlist_view')->name('frontend.wishlist');
     });
     Route::get('/checkout',[CheckoutController::class,'index'])->name('frontend.checkout');
     
 });
 Route::get('/guest_checkout',[CheckoutController::class,'guest_checkout'])->name('frontend.guest_checkout');
 Route::post('/guest_checkout',[CheckoutController::class,'gueststore'])->name('frontend.guest_checkout.store');
 

 // Cart
 Route::controller(CartController::class)->prefix('cart')->group(function(){
     Route::post('/', 'store')->name('frontend.cart.store');
     Route::delete('{product}/{cart}', 'destroy')->name('frontend.cart.destroy');
     Route::post('save-later/{product}', 'saveLater')->name('frontend.cart.save-later');
     Route::post('add-to-cart/{product}', 'addToCart')->name('frontend.cart.add-to-cart');
     Route::patch('{product}', 'update')->name('frontend.cart.update');
     Route::post('add-to-wishlist', 'addToWishlist')->name('frontend.cart.add-to-cart');
     Route::post('remove-wishlist', 'removefromWishlist')->name('frontend.wishlist.remove');
 });
        
Route::get('/cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    dd(Artisan::output());
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    dd(Artisan::output());
});
