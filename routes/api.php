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

    

    Route::post('logout', 'RiderLoginController@logout'); //骑手退出登陆
    Route::post('registered', 'RiderLoginController@registered'); //骑手注册

    Route::get('riderorderlist', 'RiderorderController@riderorderlist'); //骑手接单显示--zsywx
    Route::get('rcallbusiness', 'RiderorderController@ rcallbusiness'); //联系商家--zsywx
    Route::get('rcalluser', 'RiderorderController@rcalluser'); //联系用户--zsywx
    Route::get('riderorder', 'RiderorderController@riderorder'); //骑手订单查看--zsywx

});//--lzz  zsy
Route::prefix('business')->namespace('Business')->group(function () {
    Route::post('login', 'BusinessLoginController@login'); //商户登陆
    Route::post('logout', 'BusinessLoginController@logout'); //商户退出登陆
    Route::post('registered', 'BusinessLoginController@registered'); //商户注册
    Route::get('brefundorderlist', 'BusinessorderController@brefundorderlist');//商家退款列表--zsywx
    Route::get('brefundorder', 'BusinessorderController@brefundorder');//退款页面--zsywx
    Route::get('bfinishorder', 'BusinessorderController@bfinishorder');//已完成订单页面--zsywx
    Route::get('bdeliveryorderlist', 'BusinessorderController@bdeliveryorderlist');//派送列表--zsywx
    Route::get('bfinishorderlist', 'BusinessorderController@bfinishorderlist');//已完成列表--zsywx
    Route::get('bdeliveryorder', 'BusinessorderController@bdeliveryorder');//派送页面--zsywx
    Route::post('bbackmoney', 'BusinessorderController@bbackmoney');//退款功能--zsywx
    Route::post('bcallrider', 'BusinessorderController@bcallrider');//联系骑手--zsywx
    Route::post('briderdelivery', 'BusinessorderController@briderdelivery');//确认骑手取货 --zsywx


});//--lzz  zsy
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
    Route::any('test', 'AdminLoginController@test'); //商户注册

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



Route::prefix('user')->namespace('User')->group(function () {

    Route::get('submitorder', 'SubmitController@submitorder'); //获取商家商品信息--zsywx
    Route::get('submituorder', 'SubmitController@submituorder');//获取用户信息--zsywx
    Route::get('submitdelivery', 'SubmitController@submitdelivery');//配送费--zsywx
    Route::get('submittime', 'SubmitController@submittime');//随机时间--zsywx
    Route::get('submittotal', 'SubmitController@submittotal');//获取总价--zsywx


    Route::post('payorder', 'SubmitController@payorder');//支付页面数据--zsywx
    Route::post('pay', 'SubmitController@pay');//支付功能--zsywx
    Route::get('unomoneyorder', 'SubmitController@unomoneyorder');//未支付订单页面--zsywx
    Route::get('udelivery', 'SubmitController@udelivery');//派送订单页面--zsywx
    Route::get('urefund', 'SubmitController@urefund');//获取退款订单页面数据--zsywx
    Route::get('ufinish', 'SubmitController@ufinish');//获取完成订单页面数据--zsywx
    Route::get('unomonylist', 'SubmitController@unomonylist');//获取未付款列表数据--zsywx
    Route::get('udeliverylist', 'SubmitController@udeliverylist');//获取派送列表数据--zsywx
    Route::get('ufinishlist', 'SubmitController@ufinishlist');//获取完成列表数据--zsywx

    Route::get('urefundlist', 'SubmitController@urefundlist');//获取退款列表数据--zsywx
    Route::post('ubackorder', 'SubmitController@ubackorder');//退单功能--zsywx
    Route::post('utakeorder', 'SubmitController@utakeorder');//确认收货功能--zsywx
    Route::get('callrider', 'SubmitController@callrider');//联系骑手--zsywx
    Route::get('callbusiness', 'SubmitController@callbusiness');//联系商家--zsywx
    Route::post('assess', 'SubmitController@assess');//评价--zsywx


});//--zsy


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



