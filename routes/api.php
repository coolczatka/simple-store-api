<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::resource('products','ProductController');
Route::get('products','ProductController@index');
Route::get('products/{product}','ProductController@show');

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
// users permission
Route::middleware('jwt.auth')->group(function () {

    Route::get('user', function () {
        return auth('api')->user();
    });

    Route::get('logout','AuthController@logout');
    Route::get('orders/myorders','OrderController@index');
    Route::post('orders','OrderController@create');
});
//admin permission
Route::middleware(['jwt.auth', 'checkAdmin'])->group(function (){

    Route::get('users',function (){
        return \App\User::paginate(5);
    });

    Route::post('products','ProductController@create');
    Route::put('products/{product}','ProductController@update');
    Route::delete('products/{product}','ProductController@delete');

    Route::put('orders/{order}','OrderController@update');
    Route::delete('orders/{order}','OrderController@delete');
    Route::get('orders','OrderController@list');

});
