<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageContent\Demo2Request;
use App\Http\Requests\AssessRequest;
use App\Http\Requests\UserBackRequest;
use App\Http\Requests\UserDeliveryOrderRequest;
use App\Http\Requests\UserPayorderRequest;
use App\Http\Requests\UserPayRequest;
use App\Http\Requests\UsersubimtTotal;
use App\Http\Requests\UsersubmitorderRequest;
use App\Http\Requests\UsersubmituOrderRequest;
use App\Models\Comment;
use App\Models\Goods;
use App\Models\NewsBulletinManage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SubmitController extends Controller
{


    /***获取商品商家信息
     * @author zuoshengyu
     * @param UsersubmitorderRequest $request
     * @return json
     */
    Public function submitorder(UsersubmitorderRequest $request){

            $goods_id = $request->get('goods_id');
            $date = Goods::huoqusjsp($goods_id);

            return $date?
                json_success('获取成功!',$date,200) :
                json_fail('获取失败!',null,100);

    }

    /***获取用户数据
     * @author zuoshengyu
     * @param UsersubmituOrderRequest $request
     * @return json
     */
    Public function submituorder(UsersubmituOrderRequest $request){

        $user_id = $request->get('user_id');
        $date = User::huoquyonghu($user_id);

        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***提供配送费
     * @param UserDeliveryOrderRequest $request
     * @return json
     */
    Public function submitdelivery(UserDeliveryOrderRequest $request){

        $juli=$request->get('user_id');
        User::suijijuli($juli);
        $delivery=User::suijimoney();


        return $delivery?
            json_success('获取成功!',$delivery,200) :
            json_fail('获取失败!',null,100);

    }

    /***提供随机时间
     * @author zuoshengyu
     * @param UserDeliveryOrderRequest $request
     * @return json
     */
    Public function submittime(UserDeliveryOrderRequest $request){

        $juli=$request->get('user_id');
        User::suijijuli($juli);
        $delivery=User::suijitime();


        return $delivery?
            json_success('获取成功!',$delivery,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取支付订单页面数据
     * @author zuoshengyu
     * @param UserPayorderRequest $request
     * @return json
     */
    Public function payorder(UserPayorderRequest $request){

        $num=$request->get('num'); //总量
        $user_id=$request->get('user_id');
        $goods_id=$request->get('goods_id');

        $delivery=User::suijimoney();//配送费
        $price=Goods::gtotal($goods_id);
        $total=$price*$num+$delivery;//总价

        $yonghu=User::huoquyonghu2($user_id);//姓名 地址 电话 用户id
        $bianhao=Goods::huoqu($goods_id); //商品id +商家id

         $distance=User::suijijuli($user_id); //距离
        $time =(int)User::suijitime2();//时间
        $date=Order::addorder($yonghu,$num,$bianhao,$total,$distance,$delivery,$time);
//        $date=Order::payss($dates);

        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取总价
     * @author zuoshengyu
     * @param Request $request
     * @return json
     */
    Public function submittotal(Request $request){
        $num=$request->input('num');
        $id= $request->input('goods_id');
        $delivery=User::suijimoney();
        $total=Goods::gtotal($id);
        $date=$total*$num+$delivery;

        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /*** 支付页面的支付功能
     * @author zuoshengyu
     * @param UserPayRequest $request
     * @return json
     */
    Public function pay(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::typechange($order_id);


        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取未支付订单页面数据
     * @author zuoshengyu
     * @param UserPayRequest $request
     * @return json
     */
    Public function unomoneyorder(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::nopayyemian($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }


    /***获取派送订单页面数据
     * @author zuoshengyu
     * @param UserPayRequest $request
     * @return json
     */
    Public function udelivery(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::paisongyemian($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***退款订单页面数据获取
     * @author zuoshengyu
     * @param UserPayRequest $request
     * @return json
     */
    Public function urefund(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::tuikuanyemian($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取完成订单页面数据
     * @author zuoshengyu
     * @param UserPayRequest $request
     * @return json
     */
    Public function ufinish(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::finishyemian($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }


    /***获取未付款列表数据
     * @author zuoshengyu
     * @return json
     */
    Public function unomonylist(){

        $date=Order::listorder4();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取派送页面列表数据
     * @author zuoshengyu
     * @return \Illuminate\Http\JsonResponse
     */
    Public function udeliverylist(){

        $date=Order::listorder3();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***获取完成页面列表数据
     * @author zuoshengyu
     * @return json
     */
    Public function ufinishlist(){

        $date=Order::listorder();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***订单页面下的退款列表
     * @author zuoshengyu
     * @return json
     */
    Public function urefundlist(){
        $date=Order::listorder2();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***派送订单页面下的退单功能
     * @author zuoshengyu
     * @param  UserBackRequest $request
     * @return json
     */
    Public function ubackorder(UserBackRequest $request){
        $order_id=$request->get('order_id');
        $reason =$request->get('reason');

        $date=Order::tuidan($order_id,$reason);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***派送订单下的确认收货
     * @author zuoshengyu
     * @param  UserPayRequest $request
     * @return json
     */
    Public function utakeorder(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::typechange2($order_id);
        return $order_id?
            json_success('获取成功!',$order_id,200) :
            json_fail('获取失败!',null,100);

    }


    /***联系商家
     * @author zuoshengyu
     * @return json
     */
    Public function callbusiness(){
        $date='联系成功';
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }
    /***联系骑手
     * @author zuoshengyu
     * @return json
     */
    Public function callrider(){
    $date='联系成功';
    return $date?
        json_success('获取成功!',$date,200) :
        json_fail('获取失败!',null,100);

}

    /***
     * 增加评价
     * @author zuoshengyu
     * @param AssessRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assess(AssessRequest $request){
        $order_id=$request->get('order_id');
        $message=$request->get('message');

        $attitude=$request->get('attitude');
        $envrionment=$request->get('envrionment');
        $comment=$request->get('comment');
        $iamge_url=$request->get('iamge_url');
        $date = Comment::assess($order_id, $message, $attitude, $envrionment, $comment,upload($iamge_url) );
        return $date?
            json_success('添加评价成功!',$date,200) :
            json_fail('添加评价失败!',null,100);
    }

}
