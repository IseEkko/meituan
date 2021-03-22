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

    Route::post('login', 'RiderLoginController@login'); //骑手登陆
    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册
});//--lzz
 
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆--lzz
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆--lzz
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册--lzz
    Route::post('test', 'BusinessLoginController@test'); //商户注册--lzz
});
Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::post('login', 'AdminLoginController@login'); //商户登陆
    Route::post('logout', 'AdminLoginController@logout'); //商户退出登陆
    Route::post('registered', 'AdminLoginController@registered'); //商户注册
});//--lzz


Route::prefix('super')->namespace('Super')->group(function () {
    Route::get('showsuper', 'SuperCenterController@showSuperInfo'); //显示超级管理员的信息
    Route::post('altersuper', 'SuperCenterController@alterSuperInfo'); //修改超级管理员的信息
    Route::get('showadmin', 'SuperCenterController@showAdminInfo'); //显示管理员的信息
    Route::post('alteradmin', 'SuperCenterController@alterAdminInfo'); //修改管理员的信息
    Route::post('deleteadmin', 'SuperCenterController@deleteAdminInfo'); //删除管理员的信息
    Route::post('createadmin', 'SuperCenterController@createAdminInfo'); //增加管理员的信息
    Route::get('searchadmin', 'SuperCenterController@searchAdminInfo'); //根据姓名搜索管理员的信息
});//--cwp

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('showadmin', 'AdminCenterController@showAdminMessage'); //展示管理员信息
    Route::post('alterdmin', 'AdminCenterController@alterAdminMessage'); //修改管理员的信息
    Route::get('showbusinessoperate', 'AdminCenterController@showBusinessOperate'); //展示商家经营
    Route::get('searchbusinessoperate', 'AdminCenterController@searchBusinessOperate'); //搜索商家经营

    Route::get('realridershowed', 'AdminCenterController@riderRealNameShowed'); //展示实名认证已审批过的骑手相关信息
    Route::get('realridershowing', 'AdminCenterController@riderRealNameShowing'); //展示实名认证未审批骑手相关信息
    Route::post('riderrealnamepass', 'AdminCenterController@riderRealNamePass'); //审批骑手实名认证通过与否
    Route::get('riderrealnamesearch', 'AdminCenterController@riderRealNameSearch'); //搜索实名认证骑手相关信息


    Route::get('realbusinessshowed', 'AdminCenterController@businessRealNameShowed'); //展示实名认证已审批过的商家相关信息
    Route::get('realbusinessshowing', 'AdminCenterController@businessRealNameShowing'); //展示实名认证未审批商家相关信息
    Route::post('businessrealnamepass', 'AdminCenterController@businessRealNamePass'); //审批商家实名认证通过与否
    Route::get('realbusinesssearch', 'AdminCenterController@businessRealNameSearch'); //搜索实名认证商家相关信息
});//--cwp


Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('approvalbusinessshowed', 'BUsinessManageController@approvalBusinessShowed'); //展示商家管理中已审批商户个人信息
    Route::get('approvalbusinessshowing', 'BUsinessManageController@approvalBusinessShowing'); //展示商家管理中未审批商户个人信息
    Route::get('approvalbusinesssearch', 'BUsinessManageController@approvalBusinessSearch'); //搜索商家管理中已审批商户个人信息
    Route::post('approvalbusinesspass', 'BUsinessManageController@approvalBusinessPass'); //商家管理中审批商户个人信息

    Route::get('businessmanageshow', 'BUsinessManageController@businessManageShow'); //商家信息管理展示商家信息
    Route::post('businessmanagealter', 'BUsinessManageController@businessManageAlter'); //修改商家信息管理
    Route::post('businessmanagedelete', 'BUsinessManageController@businessManageDelete'); //删除商家信息管理
    Route::get('businessmanagedetail', 'BUsinessManageController@businessManageDetail'); //商家信息管理详情
    Route::get('businessmanagesearch', 'BUsinessManageController@businessManageSearch'); //商家信息管理查询

    Route::get('approvalgoodsshowed', 'BUsinessManageController@approvalGoodsShowed'); //展示商品信息中已审批商品的信息
    Route::get('approvalgoodsshowing', 'BUsinessManageController@approvalGoodsShowing'); //展示商品信息中未审批商品的信息
    Route::get('approvalgoodssearch', 'BUsinessManageController@approvalGoodsSearch'); //搜索商品信息中审批商品的信息
    Route::post('approvalgoodspass', 'BUsinessManageController@approvalGoodsPass'); //商品信息中的审批

    Route::get('goodsmanageshow', 'BUsinessManageController@goodsManageShow'); //商品信息管理展示商品信息
    Route::post('goodsmanagealter', 'BUsinessManageController@goodsManageAlter'); //修改商品信息管理
    Route::post('goodsmanagedelete', 'BUsinessManageController@goodsManageDelete'); //删除商品信息管理
    Route::get('goodsmanagesearch', 'BUsinessManageController@goodsManageSearch'); //商品信息管理展示商品信息
});//--cwp

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('approvalridershowed', 'RiderManageController@approvalRiderShowed'); //展示骑手管理中已审批骑手的个人信息
    Route::get('approvalridershowing', 'RiderManageController@approvalRiderShowing'); //展示骑手管理中未审批骑手的个人信息
    Route::get('approvalridersearch', 'RiderManageController@approvalRiderSearch'); //搜索骑手管理中骑手的个人信息
    Route::post('approvalriderpass', 'RiderManageController@approvalRiderPass'); //骑手信息中的审批

    Route::get('ridermanageshow', 'RiderManageController@riderManageShow'); //骑手管理中展示骑手信息
    Route::post('ridermanagealter', 'RiderManageController@riderManageAlter'); //骑手管理中修改骑手信息
    Route::post('ridermanagedelete', 'RiderManageController@riderManageDelete'); //骑手管理中删除骑手信息
    Route::get('ridermanagesearch', 'RiderManageController@riderManageSearch'); //骑手管理中搜索骑手信息

});//--cwp
=======
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
