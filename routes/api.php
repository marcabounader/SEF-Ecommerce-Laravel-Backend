<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'getProducts');
    Route::post('add-product', 'setProduct');
    // Route::get('todo/{id}', 'show');
    // Route::put('todo/{id}', 'update');
    // Route::delete('todo/{id}', 'destroy');
}); 

Route::group(['prefix' => 'admin'],function ()
{
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    Route::controller(ManageProductController::class)->group(function () {
        Route::get('products', 'getProducts');
        Route::post('add-product', 'addProduct');
        Route::post('update-product', 'updateProduct');
        Route::post('delete-product', 'deleteProduct');

    }); 
});

Route::group(['prefix' => 'user'],function ()
{
    Route::controller(UserAuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::post('add-favorite', 'addFavorite');
        Route::get('favorites', 'getFavorites');
        Route::delete('delete-favorite/{favorite_id}', 'deleteFavorite');

    
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('add-cart', 'addCart');
        Route::get('carts', 'getCarts');
        Route::delete('delete-cart/{cart_id}', 'deleteCart');

    
    });


});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'getProducts');
}); 