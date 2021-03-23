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
<<<<<<< HEAD
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆--zsywx
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册--zsywx
=======
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册
>>>>>>> origin/master
    Route::get('riderorderlist', 'RiderorderController@riderorderlist'); //骑手接单显示--zsywx
    Route::get('rcallbusiness', 'RiderorderController@ rcallbusiness'); //联系商家--zsywx
    Route::get('rcalluser', 'RiderorderController@rcalluser'); //联系用户--zsywx
    Route::get('riderorder', 'RiderorderController@riderorder'); //骑手订单查看--zsywx

});//--lzz  zsy
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册
<<<<<<< HEAD
    Route::get('brefundorderlist', 'BusinessorderController@brefundorderlist');//商家退款列表--zsywx
    Route::get('brefundorder', 'BusinessorderController@brefundorder');//退款页面--zsywx
    Route::get('bfinishorder', 'BusinessorderController@bfinishorder');//已完成订单页面--zsywx
    Route::get('bdeliveryorderlist', 'BusinessorderController@bdeliveryorderlist');//派送列表--zsywx
    Route::get('bfinishorderlist', 'BusinessorderController@bfinishorderlist');//已完成列表--zsywx
    Route::get('bdeliveryorder', 'BusinessorderController@bdeliveryorder');//派送页面--zsywx
    Route::post('bbackmoney', 'BusinessorderController@bbackmoney');//退款功能--zsywx
    Route::post('bcallrider', 'BusinessorderController@bcallrider');//联系骑手--zsywx
    Route::post('briderdelivery', 'BusinessorderController@briderdelivery');//确认骑手取货 --zsywx
=======
    Route::any('brefundorderlist', 'BusinessorderController@brefundorderlist');//商家退款列表--zsywx
    Route::any('brefundorder', 'BusinessorderController@brefundorder');//退款页面--zsywx
    Route::any('bfinishorder', 'BusinessorderController@bfinishorder');//已完成订单页面--zsywx
    Route::any('bdeliveryorderlist', 'BusinessorderController@bdeliveryorderlist');//派送列表--zsywx
    Route::any('bfinishorderlist', 'BusinessorderController@bfinishorderlist');//已完成列表--zsywx
    Route::any('bdeliveryorder', 'BusinessorderController@bdeliveryorder');//派送页面--zsywx
    Route::post('bbackmoney', 'BusinessorderController@bbackmoney');//退款功能--zsywx
    Route::post('bcallrider', 'BusinessorderController@bcallrider');//联系骑手--zsywx
>>>>>>> origin/master
});//--lzz  zsy
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::post('login', 'AdminLoginController@login'); //商户登陆
    Route::post('logout', 'AdminLoginController@logout'); //商户退出登陆
    Route::post('registered', 'AdminLoginController@registered'); //商户注册
    Route::any('test', 'AdminLoginController@test'); //商户注册

});//--lzz

Route::prefix('user')->namespace('User')->group(function () {
<<<<<<< HEAD
    Route::get('submitorder', 'SubmitController@submitorder'); //获取商家商品信息--zsywx
    Route::get('submituorder', 'SubmitController@submituorder');//获取用户信息--zsywx
    Route::get('submitdelivery', 'SubmitController@submitdelivery');//配送费--zsywx
    Route::get('submittime', 'SubmitController@submittime');//随机时间--zsywx
    Route::get('submittotal', 'SubmitController@submittotal');//获取总价--zsywx
=======
    Route::any('submitorder', 'SubmitController@submitorder'); //获取商家商品信息--zsywx
    Route::any('submituorder', 'SubmitController@submituorder');//获取用户信息--zsywx
    Route::any('submitdelivery', 'SubmitController@submitdelivery');//配送费--zsywx
    Route::any('submittime', 'SubmitController@submittime');//随机时间--zsywx
    Route::any('submittotal', 'SubmitController@submittotal');//获取总价--zsywx
>>>>>>> origin/master
    Route::post('payorder', 'SubmitController@payorder');//支付页面数据--zsywx
    Route::post('pay', 'SubmitController@pay');//支付功能--zsywx
    Route::get('unomoneyorder', 'SubmitController@unomoneyorder');//未支付订单页面--zsywx
    Route::get('udelivery', 'SubmitController@udelivery');//派送订单页面--zsywx
    Route::get('urefund', 'SubmitController@urefund');//获取退款订单页面数据--zsywx
    Route::get('ufinish', 'SubmitController@ufinish');//获取完成订单页面数据--zsywx
    Route::get('unomonylist', 'SubmitController@unomonylist');//获取未付款列表数据--zsywx
    Route::get('udeliverylist', 'SubmitController@udeliverylist');//获取派送列表数据--zsywx
    Route::get('ufinishlist', 'SubmitController@ufinishlist');//获取完成列表数据--zsywx
<<<<<<< HEAD
    Route::get('urefundlist', 'SubmitController@urefundlist');//获取退款列表数据--zsywx
    Route::post('ubackorder', 'SubmitController@ubackorder');//退单功能--zsywx
    Route::post('utakeorder', 'SubmitController@utakeorder');//确认收货功能--zsywx
    Route::get('callrider', 'SubmitController@callrider');//联系骑手--zsywx
    Route::get('callbusiness', 'SubmitController@callbusiness');//联系商家--zsywx
    Route::post('assess', 'SubmitController@assess');//评价--zsywx
=======
    Route::any('urefundlist', 'SubmitController@urefundlist');//获取退款列表数据--zsywx
    Route::any('ubackorder', 'SubmitController@ubackorder');//退单功能--zsywx
    Route::any('utakeorder', 'SubmitController@utakeorder');//确认收货功能--zsywx
    Route::any('callrider', 'SubmitController@callrider');//联系骑手--zsywx
    Route::any('callbusiness', 'SubmitController@callbusiness');//联系商家--zsywx
    Route::any('assess', 'SubmitController@assess');//评价--zsywx
>>>>>>> origin/master

});//--zsy
