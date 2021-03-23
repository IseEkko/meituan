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

});//--lzz

Route::prefix('rider')->namespace('Rider')->group(function () {
    Route::post('login', 'RiderLoginController@login'); //骑手登陆--zsywx
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆--zsywx
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册
    Route::get('riderorderlist', 'RiderorderController@riderorderlist'); //骑手接单显示
    Route::get('rcallbusiness', 'RiderorderController@ rcallbusiness'); //联系商家
    Route::get('rcalluser', 'RiderorderController@rcalluser'); //联系用户
    Route::get('riderorder', 'RiderorderController@riderorder'); //骑手订单查看

});//--lzz  zsy
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册
    Route::any('brefundorderlist', 'BusinessorderController@brefundorderlist');//商家退款列表
    Route::any('brefundorder', 'BusinessorderController@brefundorder');//退款页面
    Route::any('bfinishorder', 'BusinessorderController@bfinishorder');//已完成订单页面
    Route::any('bdeliveryorderlist', 'BusinessorderController@bdeliveryorderlist');//派送列表
    Route::any('bfinishorderlist', 'BusinessorderController@bfinishorderlist');//已完成列表
    Route::any('bdeliveryorder', 'BusinessorderController@bdeliveryorder');//派送页面
    Route::post('bbackmoney', 'BusinessorderController@bbackmoney');//退款功能
    Route::post('bcallrider', 'BusinessorderController@bcallrider');//联系骑手
});//--lzz  zsy
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::post('login', 'AdminLoginController@login'); //商户登陆
    Route::post('logout', 'AdminLoginController@logout'); //商户退出登陆
    Route::post('registered', 'AdminLoginController@registered'); //商户注册
    Route::any('test', 'AdminLoginController@test'); //商户注册

});//--lzz

Route::prefix('user')->namespace('User')->group(function () {
    Route::any('submitorder', 'SubmitController@submitorder'); //获取商家商品信息
    Route::any('submituorder', 'SubmitController@submituorder');//获取用户信息
    Route::any('submitdelivery', 'SubmitController@submitdelivery');//配送费
    Route::any('submittime', 'SubmitController@submittime');//随机时间
    Route::any('submittotal', 'SubmitController@submittotal');//获取总价
    Route::post('payorder', 'SubmitController@payorder');//支付页面数据
    Route::post('pay', 'SubmitController@pay');//支付功能
    Route::get('unomoneyorder', 'SubmitController@unomoneyorder');//未支付订单页面
    Route::get('udelivery', 'SubmitController@udelivery');//派送订单页面
    Route::get('urefund', 'SubmitController@urefund');//获取退款订单页面数据
    Route::get('ufinish', 'SubmitController@ufinish');//获取完成订单页面数据
    Route::get('unomonylist', 'SubmitController@unomonylist');//获取未付款列表数据
    Route::get('udeliverylist', 'SubmitController@udeliverylist');//获取派送列表数据
    Route::get('ufinishlist', 'SubmitController@ufinishlist');//获取完成列表数据
    Route::any('urefundlist', 'SubmitController@urefundlist');//获取退款列表数据
    Route::any('ubackorder', 'SubmitController@ubackorder');//退单功能
    Route::any('utakeorder', 'SubmitController@utakeorder');//确认收货功能
    Route::any('callrider', 'SubmitController@callrider');//联系骑手
    Route::any('callbusiness', 'SubmitController@callbusiness');//联系商家
    Route::any('assess', 'SubmitController@assess');//评价

});//--zsy
