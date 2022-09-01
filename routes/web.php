 <?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceImageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Admin Dashboard
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('slider', SliderController::class);
        Route::resource('about', AboutController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('quotation', QuotationController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('project', ProjectController::class);
        Route::resource('blog', BlogController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('order', OrderController::class);
        Route::resource('user', UserController::class);
        Route::get('/user/profile/{username}', [UserController::class, 'profile'])->name('user.profile');
        Route::post('/user/updateProfile', [UserController::class, 'updateProfile'])->name('user.updateProfile');

        Route::get('products', [ProductController::class, 'products'])->name('products');
        Route::get('product-details', [FrontendController::class, 'productDetails'])->name('productDetails');

        Route::post('change-role', [AdminController::class, 'changeRole'])->name('changeRole');
        Route::get('register-user', [AdminController::class, 'create'])->name('registerUser');
        Route::post('register-user-submit', [AdminController::class, 'store'])->name('registerUserSubmit');
        Route::get('user-profile/{id}', [AdminController::class, 'edit'])->name('userProfile');
        Route::post('user-profile-update/{id}', [AdminController::class, 'update'])->name('profileUpdate');
    });
});
Route::get('/remove-service-image/{id}', [ServiceImageController::class, 'destroy']);


// Frontend
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::prefix('/')->group(function () {
    Route::get('about-us', [FrontendController::class, 'about'])->name('about');
    Route::get('profile', [FrontendController::class, 'profile'])->name('profile');
    Route::get('ceo-message', [FrontendController::class, 'ceoMessage'])->name('ceoMessage');
    Route::get('mission', [FrontendController::class, 'mission'])->name('mission');
    Route::get('vision', [FrontendController::class, 'vision'])->name('vision');
    Route::get('history', [FrontendController::class, 'history'])->name('history');
    Route::get('es-gallery', [FrontendController::class, 'gallery'])->name('esGallery');
    Route::get('team', [FrontendController::class, 'team'])->name('team');
    Route::get('es-faq', [FrontendController::class, 'faq'])->name('esFaq');
    Route::get('categories', [CategoryController::class, 'categories'])->name('categories');
    Route::get('categories/{slug}/{id}', [CategoryController::class, 'categoryServices'])->name('categoryServices');

    Route::get('services', [ServiceController::class, 'services'])->name('services');
    Route::get('services/{slug}/{id}', [ServiceController::class, 'serviceDetails'])->name('serviceDetails');
    Route::get('blogs', [BlogController::class, 'blogs'])->name('blogs');
    Route::get('blogs/{slug}/{id}', [BlogController::class, 'blogDetails'])->name('blogDetails');

    Route::get('projects', [ProjectController::class, 'projects'])->name('projects');
    Route::get('project-details/{id}', [ProjectController::class, 'show'])->name('projectDetails');
    Route::get('all-news', [FrontendController::class, 'news'])->name('newsView');
    Route::get('news-details', [FrontendController::class, 'newsDetails'])->name('newsDetails');
    Route::get('contact-us', [ContactController::class, 'create'])->name('esContact');
    Route::get('create-quotation', [QuotationController::class, 'create'])->name('quotationCreate');
    Route::get('reservation/{slug}/{id}', [QuotationController::class, 'serviceReservation'])
    ->name('serviceReservation');
    Route::post('store-quotation', [QuotationController::class, 'store'])->name('quotationStore');
    Route::get('sendMail', [MailController::class, 'endMail']);
    Route::post('send-contact-message', [ContactController::class, 'store'])->name('sendContactMessage');
});



// OLD

Route::get('/checkout', function () {
    return view('checkout');
});


Route::resource('invoice', 'InvoiceController');

// Dashboard
Route::get('/slider-delete/{id}', 'SliderController@destroy')->name('sliderDelete');

// Admin
// Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('admin');
Route::get('/home', 'HomeController@index')->name('home');

// Login
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-check', [LoginController::class, 'loginCheck'])->name('loginCheck');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
