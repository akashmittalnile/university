<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return '<h1>migrate success</h1>';
});


Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
Route::get('/accomplishment-gallety', [FrontendController::class, 'accomplishment'])->name('accomplishment');
Route::get('/mark-network', [FrontendController::class, 'markNetwork'])->name('markNetwork');
Route::get('/mark-burnet-foundation', [FrontendController::class, 'markBurnet'])->name('markBurnet');
Route::get('/resources', [FrontendController::class, 'resources'])->name('resources');
Route::get('/podcast', [FrontendController::class, 'podcast'])->name('podcast');
Route::get('/view-podcast/{id}', [FrontendController::class, 'viewPodcast'])->name('view.podcast');
Route::get('/blogs', [FrontendController::class, 'blog'])->name('blogs');
Route::get('/blog/{id}', [FrontendController::class, 'blogDetails'])->name('blog.details');
Route::get('/e-book', [FrontendController::class, 'e_book'])->name('e_book');
Route::post('/contactSave', [FrontendController::class, 'contactSave'])->name('contactSave');
Route::get('/affiliate', [FrontendController::class, 'affiliate'])->name('affiliate');



Route::get('/sign-in', [FrontendController::class, 'signin'])->name('signin');
Route::get('login', [FrontendController::class, 'signin'])->name('login');
Route::get('/sign-up', [FrontendController::class, 'signup'])->name('signup');


Route::get('/forgot-password', [FrontendController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password-send-otp', [FrontendController::class, 'forgotPasswordSendOTP'])->name('forgot.password.send-otp');
Route::get('/verify-otp/{email}', [FrontendController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/verifying-otp', [FrontendController::class, 'verifyingOTP'])->name('verifying.otp');
Route::get('/reset-password/{email}', [FrontendController::class, 'resetPassword'])->name('reset.password');
Route::post('/update-password', [FrontendController::class, 'updatePassword'])->name('update.password');



// Admin Routes

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::middleware(["auth"])->group(function () {
        Route::get('profile', [FrontendController::class, 'profile'])->name('profile');
        Route::get('subscription', [FrontendController::class, 'subscription'])->name('subscription');
        Route::post('purchase', [PlanController::class, 'purchase'])->name('purchase');
        Route::get("logout", [UserController::class, 'logout'])->name('logout');
    });
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('home');

    Route::get('/signin', [AdminController::class, 'signin'])->name('signin');
    Route::post('signin', [AdminController::class, 'signin_post'])->name('signin.post');
    
    Route::middleware(["auth", "admin"])->group(function () {
        Route::get('check-password', [AdminController::class, 'checkPassword'])->name('check.password');

        // dashboard
        Route::get("dashboard", [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get("dashboard-download-report", [AdminController::class, 'dashboardDownloadReport'])->name('dashboard.download.report');

        //  user management
        Route::get("users", [UserController::class, 'index'])->name('users.index');
        Route::get("view-details/{id}", [UserController::class, 'viewDetails'])->name('users.view.details');
        Route::post('user-change-status', [UserController::class, 'userChangeStatus'])->name('users.change.status');
        Route::get('approve-reject/{id}/{status}', [UserController::class, 'approveReject'])->name('users.approve.reject');
        Route::get("user-detail-download-report/{id}", [UserController::class, 'userDetailDownloadReport'])->name('user-detail.download.report');

        //  membership
        Route::resource("plans", PlanController::class);
        Route::post("plans-update/{id}", [PlanController::class, 'update'])->name('plan.update');
        Route::get("fetch-plans", [PlanController::class, 'getPlans'])->name('plans.fetch');

        //  ebooks
        Route::get("ebooks", [EbookController::class, 'index'])->name('ebooks');
        Route::get("create-ebook", [EbookController::class, 'create'])->name('ebooks.create');
        Route::post("store-ebook", [EbookController::class, 'store'])->name('ebooks.store');
        Route::get("edit-ebook/{id}", [EbookController::class, 'edit'])->name('ebooks.edit');
        Route::post("update-ebook/{id}", [EbookController::class, 'update'])->name('ebooks.update');
        Route::get("delete-ebook/{id}", [EbookController::class, 'destroy'])->name('ebooks.destroy');

        //  podcasts
        Route::get("podcasts", [PodcastController::class, 'index'])->name('podcasts');
        Route::get("create-podcast", [PodcastController::class, 'create'])->name('podcasts.create');
        Route::post("store-podcast", [PodcastController::class, 'store'])->name('podcasts.store');
        Route::get("edit-podcast/{id}", [PodcastController::class, 'edit'])->name('podcasts.edit');
        Route::post("update-podcast/{id}", [PodcastController::class, 'update'])->name('podcasts.update');
        Route::get("delete-podcast/{id}", [PodcastController::class, 'destroy'])->name('podcasts.destroy');

        //  products
        Route::get("products", [ProductController::class, 'index'])->name('product');
        Route::get("create-product", [ProductController::class, 'create'])->name('product.create');
        Route::post("store-product", [ProductController::class, 'store'])->name('product.store');
        Route::get("edit-product/{id}", [ProductController::class, 'edit'])->name('product.edit');
        Route::post("update-product/{id}", [ProductController::class, 'update'])->name('product.update');
        Route::get("delete-product/{id}", [ProductController::class, 'destroy'])->name('product.destroy');
        Route::post('product-image-upload', [ProductController::class, "imageUpload"])->name('product.image.upload');
        Route::post('product-image-delete', [ProductController::class, "imageDelete"])->name('product.image.delete');
        Route::get('product-uploaded-image-delete/{id}', [ProductController::class, "uploadedImageDelete"])->name('product.uploaded.image.delete');

        //  blogs
        Route::get("blogs", [BlogController::class, 'index'])->name('blog');
        Route::get("create-blog", [BlogController::class, 'create'])->name('blog.create');
        Route::post("store-blog", [BlogController::class, 'store'])->name('blog.store');
        Route::get("edit-blog/{id}", [BlogController::class, 'edit'])->name('blog.edit');
        Route::post("update-blog/{id}", [BlogController::class, 'update'])->name('blog.update');
        Route::get("delete-blog/{id}", [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::post('blog-image-upload', [BlogController::class, "imageUpload"])->name('blog.image.upload');
        Route::post('blog-image-delete', [BlogController::class, "imageDelete"])->name('blog.image.delete');
        Route::get('blog-uploaded-image-delete/{id}', [BlogController::class, "uploadedImageDelete"])->name('blog.uploaded.image.delete');

        // Content Management
        Route::get("about", [ContentController::class, 'about'])->name('about');
        Route::post("about", [ContentController::class, 'aboutSave'])->name('about.save');

        Route::get("mark-network", [ContentController::class, 'markNetwork'])->name('markNetwork');
        Route::post("mark-network", [ContentController::class, 'markNetworkSave'])->name('markNetwork.save');

        Route::get("affiliate", [ContentController::class, 'affiliate'])->name('affiliate');
        Route::post("affiliate", [ContentController::class, 'affiliateSave'])->name('affiliate.save');

        Route::get("resources", [ContentController::class, 'resources'])->name('resources');
        Route::post("resources", [ContentController::class, 'resourcesSave'])->name('resources.save');

        Route::get("gallery", [ContentController::class, 'gallery'])->name('gallery');
        Route::post('gallery-image-upload', [ContentController::class, "imageUpload"])->name('gallery.image.upload');
        Route::post('gallery-image-delete', [ContentController::class, "imageDelete"])->name('gallery.image.delete');
        Route::get('gallery-uploaded-image-delete/{id}', [ContentController::class, "uploadedImageDelete"])->name('gallery.uploaded.image.delete');
        Route::post("gallery", [ContentController::class, 'gallerySave'])->name('gallery.save');

        // manage image
        Route::get("image", [ImageController::class, 'image'])->name('image');
        Route::post('image-upload', [ImageController::class, "imageUpload"])->name('image.upload');
        Route::post('image-delete', [ImageController::class, "imageDelete"])->name('image.delete');
        Route::get('uploaded-image-delete/{id}', [ImageController::class, "uploadedImageDelete"])->name('uploaded.image.delete');
        Route::post("image", [ImageController::class, 'imageSave'])->name('image.save');

        Route::get("markBurnet", [ContentController::class, 'markBurnet'])->name('markBurnet');
        Route::post("markBurnet", [ContentController::class, 'markBurnetSave'])->name('markBurnet.save');

        // contacts
        Route::get("contacts", [ContentController::class, 'contacts'])->name('contacts');
        Route::get("contact-download-report", [ContentController::class, 'contactDownloadReport'])->name('contact.download.report');

        // Admin Profile
        Route::get("profile", [AdminController::class, 'profile'])->name('profile');
        Route::post("profile", [AdminController::class, 'profile_update'])->name('profile.post');
        Route::get("logout", [AdminController::class, 'logout'])->name('logout');
    });
});
