<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'can:viewAdmin'], 'prefix' => config('novabolt.admin_prefix'), 'as' => 'admin.'], function () {
    Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{user}/wallet/deposit', [\App\Http\Controllers\Admin\UserWalletController::class, 'deposit'])->name('users.wallet.deposit');
    Route::post('users/{user}/wallet/refresh', [\App\Http\Controllers\Admin\UserWalletController::class, 'refresh'])->name('users.wallet.refresh');
    Route::resource('markets', \App\Http\Controllers\Admin\MarketController::class);
    Route::resource('vendors', \App\Http\Controllers\Admin\VendorController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('orders.charges', \App\Http\Controllers\Admin\OrderChargeController::class);
    Route::resource('orders.transactions', \App\Http\Controllers\Admin\OrderTransactionController::class);
    Route::resource('orders.shipments', \App\Http\Controllers\Admin\OrderShipmentController::class);
    Route::resource('orders.comments', \App\Http\Controllers\Admin\OrderCommentController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('products.charges', \App\Http\Controllers\Admin\ProductChargeController::class);
    Route::resource('transactions', \App\Http\Controllers\Admin\TransactionController::class);
    Route::resource('shipments', \App\Http\Controllers\Admin\ShipmentController::class);
    Route::resource('comments', \App\Http\Controllers\Admin\CommentController::class);
});

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', \App\Http\Controllers\User\DashboardController::class)->name('dashboard');
    Route::get('profile', [\App\Http\Controllers\User\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', \App\Http\Controllers\User\PasswordController::class)->name('password.update');
    Route::get('wallet', [\App\Http\Controllers\User\WalletController::class, 'show'])->name('wallet.show');
    Route::get('cart', [\App\Http\Controllers\User\CartController::class, 'show'])->name('cart.show');
    Route::post('cart/products', [\App\Http\Controllers\User\CartController::class, 'addProduct'])->name('cart.products.store');
    Route::put('cart/products/{product}', [\App\Http\Controllers\User\CartController::class, 'updateProduct'])->name('cart.products.update');
    Route::delete('cart/products/{product}', [\App\Http\Controllers\User\CartController::class, 'destroyProduct'])->name('cart.products.destroy');
    Route::delete('cart/orders/{order}', [\App\Http\Controllers\User\CartController::class, 'destroyOrder'])->name('cart.orders.destroy');
    Route::post('cart/orders/{order}', [\App\Http\Controllers\User\CartController::class, 'confirmOrder'])->name('cart.orders.confirm');
    Route::get('orders', [\App\Http\Controllers\User\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', [\App\Http\Controllers\User\OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [\App\Http\Controllers\User\OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/{order}', [\App\Http\Controllers\User\OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/payments', [\App\Http\Controllers\User\OrderPaymentController::class, 'store'])->name('orders.payments.store');
    Route::post('orders/{order}/comments', [\App\Http\Controllers\User\OrderCommentController::class, 'store'])->name('orders.comments.store');
});

require __DIR__.'/auth.php';
