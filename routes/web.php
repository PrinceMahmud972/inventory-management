<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum'])->group(function () {

    // CATEGORY
    Route::resource('categories', CategoriesController::class);
    Route::get('/api/categories', [CategoriesController::class, 'getCategoriesJson']);


    Route::resource('brands', BrandController::class);
    Route::get('/api/brands', [BrandController::class, 'getBrandsJson']);


    Route::resource('sizes', SizeController::class);
    Route::get('/api/sizes', [SizeController::class, 'getSizesJson']);

    Route::resource('products', ProductController::class);

});
