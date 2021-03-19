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
Route::prefix('super')->namespace('Super')->group(function () {
    Route::post('login', 'SuperLoginController@login'); //超级管理员登陆
    Route::post('logout', 'SuperLoginController@logout'); //超级退出登陆
    Route::post('registered', 'SuperLoginController@registered'); //
    Route::any('test', 'SuperLoginController@test'); //骑手注册
});//--lzz

Route::prefix('rider')->namespace('Rider')->group(function () {
    Route::post('login', 'RiderLoginController@login'); //骑手登陆
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册

});//--lzz
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册
    Route::post('test', 'BusinessLoginController@test'); //商户注册

});//--lzz
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::post('login', 'AdminLoginController@login'); //商户登陆
    Route::post('logout', 'AdminLoginController@logout'); //商户退出登陆
    Route::post('registered', 'AdminLoginController@registered'); //商户注册
});//--lzz
