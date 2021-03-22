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
Route::prefix('rider')->namespace('Rider')->group(function () {
    Route::get('showreceivingorderall', 'RiderReceivingOrderController@showreceivingorderall'); //展示抢单总页面
    Route::get('showreceivingorder', 'RiderReceivingOrderController@showreceivingorder'); //展示抢单对应页面
    Route::post('catchreceivingorder', 'RiderReceivingOrderController@catchreceivingorder'); //实现骑手抢单

    Route::get('showrideruserinformationall', 'RiderInformationController@showrideruserinformationall'); //展示当前骑手与所有用户消息
    Route::get('showriderbusinessinformationall', 'RiderInformationController@showriderbusinessinformationall'); //展示当前骑手与所有商家消息
    Route::get('showbusinessuserinformationall', 'RiderInformationController@showbusinessuserinformationall'); //展示当前商家与所有用户消息
    Route::get('showbusinessriderinformationall', 'RiderInformationController@showbusinessriderinformationall'); //展示当前商家与所有骑手消息
    Route::get('showuserbusinessinformationall', 'RiderInformationController@showuserbusinessinformationall'); //展示当前用户与所有商家消息
    Route::get('showuserriderinformationall', 'RiderInformationController@showuserriderinformationall'); //展示当前用户与所有骑手消息

    Route::get('showrideruserinformation', 'RiderInformationController@showrideruserinformation'); //展示当前骑手与用户对话消息
    Route::get('showriderbusinessinformation', 'RiderInformationController@showriderbusinessinformation'); //展示当前骑手与商家对话消息
    Route::get('showuserbusinessinformation', 'RiderInformationController@showuserbusinessinformation'); //展示当前用户与商家对话消息

    Route::post('talkrideruserinformation', 'RiderInformationController@talkrideruserinformation'); //发送当前骑手与用户对话信息
    Route::post('talkriderbusinessinformation', 'RiderInformationController@talkriderbusinessinformation'); //发送当前骑手与商家对话信息
    Route::post('talkuserbusinessinformation', 'RiderInformationController@talkuserbusinessinformation'); //发送当前商家与用户对话信息
});//--唐邦彦
