<?php

use App\Http\Livewire\StripePay;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;

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



// Home
Route::get('/', [PublicController::class , 'welcome'])->name('welcome');

// Rotta Profilo
Route::get('/profile', [PublicController::class , 'profile'])->name('profile');

// Rotta creazione prodotti ADMIN
Route::get('/create', [ProductController::class , 'create'])->name('create');
Route::get('/orders', [OrderController::class , 'orders'])->name('orders');



// Rotta visualizzazione tutti i prodotti
Route::get('/products', [ProductController::class , 'index'])->name('product_index');

// Rotta visualizzazione dettaglio prodotto
Route::get('/products/detail/{product}', [ProductController::class , 'show'])->name('product_detail');

// Rotta Dashboard
Route::get('/dashboard', [ProductController::class , 'dashboard'])->name('dashboard');

// Rotta Edit Prodotto
Route::get('/edit/{product}', [ProductController::class , 'edit'])->name('edit');

// Rotta Eliminazione Prodotto
Route::delete('/delete/{product}', [ProductController::class , 'destroy'])->name('delete');

// Add to Cart
Route::get('/cart/', [CartController::class , 'cartsummary'])->name('cartsummary');

// WishList
Route::get('/wishlist', [ProductController::class , 'wishlist'])->name('wishlist');

Route::get('/success', [PaymentController::class , 'success'])->name('checkout.success');
Route::get('/canceled', [PaymentController::class , 'canceled'])->name('checkout.canceled');
Route::get('/shipping_info', [PaymentController::class , 'shipping'])->name('shipping');
Route::post('/checkout', [PaymentController::class , 'checkout'])->name('checkout');
Route::post('/webhook', [PaymentController::class , 'webhook'])->name('webhook');


// Route::get('/stripe', StripePay::class)->name('stripe');





