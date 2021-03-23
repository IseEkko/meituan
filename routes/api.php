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



Route::prefix('user')->namespace('User')->group(function () {
    Route::get('showlunbo', 'UserHomePageController@ShowLunBo'); //轮播图   成功
    Route::get('showall', 'UserHomePageController@ShowAll'); //用户首页展示全部商家信息    成功
    Route::get('showremen', 'UserHomePageController@ShowReMen'); //热门推荐   成功
    //Route::get('showremenmore', 'UserHomePageController@ShowRemenMore'); //热门推荐更多

});//--tg
Route::prefix('user')->namespace('User')->group(function () {
    Route::get('location', 'UserAddressController@Location'); //地址定位--tg
    Route::post('getaddress', 'UserAddressController@GetAddress'); //选择收货地址--tg
    Route::get('deladdress', 'UserAddressController@DelAddress'); //删除收货地址--tg

});//--tg
Route::prefix('user')->namespace('User')->group(function () {
    Route::post('quirygoods', 'UserOrderController@QuiryGoods'); //根据商家名称查询商品--tg   成功
    //Route::post('diancangoods', 'UserOrderController@DianCanGoods'); //根据商品名称来点餐--tg
    //Route::post('jiesuangoods', 'UserOrderController@JieSuanGoods'); //根据商品名称来点餐--tg
    //Route::post('xiangqinggoods', 'UserOrderController@XiangQingGoods'); //根据商品名称来点餐--tg
    Route::get('pingjiagoods', 'UserOrderController@PingJiaGoods'); //商家商品评价--tg
    //Route::post('businesszizhi', 'UserOrderController@BusinessZiZhi'); //--tg
});//--tg

Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('delete', 'BusinessUserController@delete'); //删除当前订单--tg    成功
    Route::get('showall', 'BusinessUserController@ShowAll'); //当前商户所有订单--tg
    Route::get('showinfo', 'BusinessUserController@ShowInfo'); //当前商户信息-- tg     
    Route::get('pingjia', 'BusinessUserController@PingJia'); //当前商品评价--tg
    Route::get('showxiangqing', 'BusinessUserController@ShowXiangQing'); //当前店铺中评价详情--tg     成功
    Route::get('showbusinessinfo', 'BusinessUserController@ShowBusinessInfo'); //商家简介--tg   成功
    Route::get('businessorderinfo', 'BusinessUserController@BusinessOrderInfo'); //商家产看某一条评论的具体信息--tg    成功
    Route::post('addgoodsnew','BusinessUserController@AddGoodsNew');//商家上新产品--tg    成功
    Route::post('addgoodsrexiao','BusinessUserController@AddGoodsReXiao');//商家上新热销产品--tg    成功
    Route::post('addgoodsyouhui','BusinessUserController@AddGoodsYouHui');//商家上新优惠产品--tg    成功
});//--tg


