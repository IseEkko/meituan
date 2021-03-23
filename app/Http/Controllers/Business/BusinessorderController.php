<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessIdRequest;
use App\Http\Requests\UserPayRequest;
use App\Models\Business;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;

class BusinessorderController extends Controller
{
    /***退款列表
     *@author zuoshengyuwx
     * @return json
     */
    Public function brefundorderlist(){

        $date=Business::tuilist();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***退款页面
     * @author zuoshengyuwx
     * @param UserPayRequest $request
     * @return json
     */
    Public function brefundorder(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Business::tuiye($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***已完成订单页面
     * @author zuoshengyuwx
     * @param UserPayRequest $request
     * @return json
     */
    Public function bfinishorder(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Business::finishye($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***派送订单列表
     * @author zuoshengyuwx
     * @return json
     */
    Public function bdeliveryorderlist(){

        $date=Business::paylist();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }
    /***已完成订单列表
     * @author zuoshengyuwx
     * @return json
     */
    Public function bfinishorderlist(){

        $date=Business::finishlist();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***商家订单派送页面
     * @author zuoshengyuwx
     * @param UserPayRequest $request
     * @return json
     */
    Public function bdeliveryorder(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Business::paiye($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***退款功能
     * @author zuoshengyuwx
     * @param UserPayRequest $request
     * @return json
     */
    Public function bbackmoney(UserPayRequest $request){
        $order_id=$request->get('order_id');
        Order::typechangeb($order_id);
        $getGoods_idAndNum = Order::getGoods_idAndNum($order_id);
        $date=Goods::reduceGoods_num($getGoods_idAndNum[0]->num,$getGoods_idAndNum[0]->goods_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***联系骑手
     * @author zuoshengyuwx
     * @return json
     */
    Public function bcallrider(){
        $date='联系成功';
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }

    /***骑手确认取货功能
     *   * @author zuoshengyuwx
     * @return json
     */
    Public function briderdelivery(UserPayRequest $request){
        $order_id=$request->get('order_id');
        $date=Order::typechangef($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);

    }
}
