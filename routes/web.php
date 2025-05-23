<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignUpUmkmController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\UmkmProductController;
use App\Http\Controllers\AdsUmkmController;
use App\Http\Controllers\ShowMerchantController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\OrderController;

Route::prefix('/admin')->group(function() {
    Route::prefix('/user')->group(function(){
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('/{id}', [UserController::class, 'destroy']);
    });
    Route::prefix('/umkm')->group(function() {
        Route::get('/', [UmkmController::class, 'index']);
        Route::post('/', [UmkmController::class, 'store']);
        Route::put('/{id}', [UmkmController::class, 'update']);
        Route::get('/{id}', [UmkmController::class, 'destroy']);
    });
    Route::prefix('/category')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::get('/{id}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('/products')->group(function() {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::get('/{id}', [ProductController::class, 'destroy']);
    });
    Route::prefix('/ads')->group(function() {
        Route::get('/', [AdsController::class, 'index']);
        Route::post('/', [AdsController::class, 'store']);
        Route::put('/{id}', [AdsController::class, 'update']);
        Route::get('/{id}', [AdsController::class, 'destroy']);
    });
    Route::prefix('/carts')->group(function() {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
        Route::put('/{id}', [CartController::class, 'update']);
        Route::get('/{id}', [CartController::class, 'destroy']);
    });
    Route::get('/', function () {
        return view('admin.index');
    });
});

Route::prefix('/umkm')->group(function() {
    Route::prefix('/signup')->group(function() {
        Route::get('/', [SignUpUmkmController::class, 'index']);
        Route::post('/', [SignUpUmkmController::class, 'store']);
    });
    Route::prefix('/product')->group(function() {
        Route::get('/', [UmkmProductController::class, 'index']);
        Route::post('/', [UmkmProductController::class, 'store']);
        Route::put('/{id}', [UmkmProductController::class, 'update']);
        Route::get('/{id}', [UmkmProductController::class, 'destroy']);
    });
    Route::prefix('/ads')->group(function() {
        Route::get('/', [AdsUmkmController::class, 'index']);
        Route::post('/', [AdsUmkmController::class, 'store']);
        Route::put('/{id}', [AdsUmkmController::class, 'update']);
        Route::get('/{id}', [AdsUmkmController::class, 'destroy']);
    });
    Route::prefix('/profile')->group(function() {
        Route::get('/', [UmkmProfileController::class, 'index']);
        Route::get('/edit', [UmkmProfileController::class, 'showEdit']);
        Route::post('/', [UmkmProfileController::class, 'store']);
        Route::put('/{id}', [UmkmProfileController::class, 'update']);
        Route::get('/{id}', [UmkmProfileController::class, 'destroy']);
    });
    Route::get('/status/{status}', function($status) {
        return view('statusUmkm', ['status' => $status]);
    });
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/merchant/{id}', [ShowMerchantController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

Route::prefix('/cart')->group(function() {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('/{id}', [CartController::class, 'updateQty']);
});

Route::prefix('/checkout')->group(function() {
    Route::get('/page', [CheckoutController::class, 'show']);
    Route::post('/', [CheckoutController::class, 'index']);
    Route::post('/order', [CheckoutController::class, 'store']);
});

Route::prefix('/payment')->group(function() {
    Route::get('/{id}', [PaymentsController::class, 'paymentPage']);
    Route::get('/check/{id}', [PaymentsController::class, 'checkPayment']);
});

Route::prefix('/webhook')->group(function() {
    Route::post('/ewallet', [WebhookController::class, 'handleEwallet']);
    Route::post('/disbursement', [WebhookController::class, 'handleDisbursement']);
});

Route::prefix('/order')->group(function() {
    Route::get('/', [OrderController::class, 'orderUserPage']);
    Route::get('/{id}', [OrderController::class, 'showUserPage']);
});

Route::prefix('/profile')->group(function() {
    Route::get('/', [ProfileController::class, 'index']);
    Route::get('/edit', [ProfileController::class, 'showEdit']);
    Route::post('/', [ProfileController::class, 'store']);
    Route::put('/{id}', [ProfileController::class, 'update']);
});

// Halaman daftar produk
Route::get('/produk/{id}', [ProdukController::class, 'index'])->name('products.index');
// Halaman detail produk
// Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('product.detail');
