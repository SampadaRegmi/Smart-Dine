<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/headerfooter', function () {
    return view('User.Layouts.headerfooter');
});

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.showForm');
// Handle the form submission
Route::post('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('User/Pages/profile/edit', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::put('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('user.updateProfile');
});


// Using Auth::routes() for standard authentication routes
Auth::routes();

// for admin dashboard (prefix is used like (127.0.0.1:8000/admin/dashboard))
Route::prefix('admin')->middleware(['admin', 'verified'])->group(function () {
    // set name as admin.dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // for user controller
    Route::resource('/user', UserController::class);
    Route::resource('/menu', MenuController::class);
});

Route::get('/admin/pages/feedback', [AdminController::class, 'showFeedback'])->name('admin.pages.feedback');

Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->name('verification.resend');

Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category', 'App\Http\Controllers\MenuController@category')->name('category');
Route::get('/appetizers', [MenuController::class, 'showAppetizers'])->name('appetizers');
Route::get('/desserts', [MenuController::class, 'showDesserts'])->name('desserts');
Route::get('/drinks', [MenuController::class, 'showDrinks'])->name('drinks');
Route::get('/entree', [MenuController::class, 'showEntree'])->name('entree');
Route::get('/salads', [MenuController::class, 'showSalads'])->name('salads');
Route::post('/menu/search', [MenuController::class, 'search'])->name('menu.search');


// Cart routes
Route::middleware('auth')->group(function () {
    Route::resource('cart', CartController::class);
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');  
});

// Payment routes
// Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
// Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
// Route::post('/khalti/payment/verify', [PaymentController::class, 'verifyPayment'])->name('khalti.verifyPayment');
// Route::post('/khalti/payment/store', [PaymentController::class, 'storePayment'])->name('khalti.storePayment');
// Route::post('/update-payment-status', 'PaymentController@updatePaymentStatus');


// Order routes
Route::post('/orders/store-from-cart', [OrderController::class, 'storeFromCart'])->name('orders.storeFromCart');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{orderId}/review', [OrderController::class, 'review'])->name('order.review');
Route::post('/submit-review/{orderId}', [OrderController::class, 'submitReview'])->name('review.submit');
Route::view('/order/success', 'orders.success')->name('order.success');
Route::get('/menu/{menu}/reviews', [MenuController::class, 'showReviews'])->name('menu.reviews');





// Payment routes
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
Route::post('/khalti/payment/verify', [PaymentController::class, 'verifyPayment'])->name('khalti.verifyPayment');
Route::post('/khalti/payment/store', [PaymentController::class, 'storePayment'])->name('khalti.storePayment');


