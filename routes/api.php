<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
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

    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('admin-login', 'login');
        Route::post('admin-register', 'register');
    });
    Route::controller(UserAuthController::class)->group(function () {
        Route::post('user-login', 'login');
        Route::post('user-register', 'register');

    });
Route::group(['prefix' => 'admin','middleware' => ['user-access:admins','jwt.auth']],function ()
{
    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });

    Route::controller(ManageProductController::class)->group(function () {
        Route::get('products', 'getProducts');
        Route::post('add-product', 'addProduct');
        Route::post('update-product', 'updateProduct');
        Route::delete('delete-product', 'deleteProduct');

    }); 
});


Route::group(['prefix' => 'user','middleware' => ['user-access:users','jwt.auth']],function ()
{
    Route::controller(UserAuthController::class)->group(function () {

        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::post('add-favorite', 'addFavorite');
        Route::get('favorites', 'getFavorites');
        Route::delete('delete-favorite/{product_id}', 'deleteFavorite');

    
    });

    Route::controller(CartController::class)->group(function () {
        Route::post('add-cart', 'addCart');
        Route::get('carts', 'getCarts');
        Route::delete('delete-cart/{product_id}', 'deleteCart');
        Route::put('update-quantity', 'updateQuantity');

    
    });
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'getProducts');
}); 