<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\DishController as D;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [F::class, 'home'])->name('start')->middleware('roles:A|C');
Route::get('/dish/{dish}', [F::class, 'showDish'])->name('show-dish')->middleware('roles:A|C');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart')->middleware('roles:A|C');
Route::get('/cart', [F::class, 'cart'])->name('cart')->middleware('roles:A|C');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart')->middleware('roles:A|C');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|C');


Route::prefix('admin/restaurants')->name('restaurants-')->group(function () {
    Route::get('/', [R::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [R::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [R::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{restaurant}', [R::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{restaurant}', [R::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{restaurant}', [R::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/dishes')->name('dishes-')->group(function () {
    Route::get('/', [D::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/show/{dish}', [D::class, 'show'])->name('show')->middleware('roles:A');
    Route::get('/create', [D::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [D::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{dish}', [D::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{dish}', [D::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{dish}', [D::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');