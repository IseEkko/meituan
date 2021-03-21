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
    Route::post('login', 'SuperLoginController@login'); //超级管理员登陆--lzz
    Route::post('logout', 'SuperLoginController@logout'); //超级退出登陆--lzz
    Route::post('registered', 'SuperLoginController@registered'); //骑手注册--lzz
});

Route::prefix('rider')->namespace('Rider')->group(function () {
    Route::post('login', 'RiderLoginController@login'); //骑手登陆--lzz
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆--lzz
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册--lzz
});
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆--lzz
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆--lzz
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册--lzz
    Route::post('test', 'BusinessLoginController@test'); //商户注册--lzz
});
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::post('login', 'AdminLoginController@login'); //普通管理员登陆--lzz
    Route::post('logout', 'AdminLoginController@logout'); //普通管理员退出登陆--lzz
    Route::post('registered', 'AdminLoginController@registered'); //普通管理员注册--lzz
});
Route::prefix('user')->namespace('User')->group(function () {
    Route::post('getinfo', 'UserLoginController@getInfo'); //微信用户获取openid--lzz
    Route::post('adduser', 'UserLoginController@addUser'); //将微信用户添加到数据库中--lzz
});
Route::prefix('bushome')->namespace('Business')->group(function () {
    Route::get('businfo', 'BusinessHomeController@getBusInFo'); //商家详情--lzz
    Route::post('busupdate','BusinessHomeController@upDateInFo');//商家详情修改--lzz
    Route::post('bustou', 'BusinessHomeController@getTou'); //商家头像展示--lzz
    Route::post('busuptou', 'BusinessHomeController@upDateTou'); //商家头像修改--lzz
    Route::post('moneyshow', 'BusinessHomeController@moneyShow'); //商家钱包展示--lzz
    Route::post('addmoney', 'BusinessHomeController@addMoney'); //商家钱包充值--lzz
    Route::post('emailpass', 'BusinessHomeController@emailPass'); //商家邮箱验证发送--lzz
    Route::get('pass', 'BusinessHomeController@Pass'); //商家邮箱验证发送--lzz
    Route::post('updatepass', 'BusinessHomeController@updatePass'); //商家密码修改--lzz
});
Route::prefix('userhome')->namespace('User')->group(function () {
    Route::post('showmoney', 'UserHomeController@showMoney'); //用户钱包展示--lzz
    Route::post('useraddmoney', 'UserHomeController@userAddMoney'); //用户充值--lzz
});
Route::prefix('riderhome')->namespace('Rider')->group(function () {
    Route::post('getridertou', 'RiderHomeController@getRiderTou'); //获取骑手头像--lzz
    Route::post('updatetou', 'RiderHomeController@updateTou'); //修改骑手头像--lzz
    Route::get('getriderperson', 'RiderHomeController@getRiderperson'); //骑手详情展示--lzz
    Route::post('updateriderp', 'RiderHomeController@updateRider'); //骑手详情修改--lzz
    Route::get('showridermoney', 'RiderHomeController@showRiderMoney'); //骑手钱包展示--lzz
    Route::post('updateridermoney', 'RiderHomeController@updateRiderMoney'); //骑手钱包充值--lzz
    Route::post('rideremail', 'RiderHomeController@riderEmail'); //骑手邮箱验证--lzz
    Route::get('pass', 'RiderHomeController@Pass'); //骑手邮箱验证状态修改--lzz
    Route::post('updatepass', 'RiderHomeController@updatePass'); //骑手密码修改--lzz
});
