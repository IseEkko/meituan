<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    public $timestamps = true;
    protected $primaryKey = "order_id";
    protected $guarded = [];

    /**
     *展示抢单总页面
     * @author tangbangyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_showReceivingOrderAll()
    {
        try{
            $date=Order::join('business' ,'business.business_id' , 'order.business_id' )
                ->join('goods','goods.goods_id','order.goods_id')
                ->select('order.*','business.name','goods.price','goods.goods_name')
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到抢单总页面',[$e->getMessage()]);
        }
    }
    /**
     *展示抢单对应页面
     * @author tangbangyan <github.com/doublebean>
     * @param  $order_id
     * @return mixed
     */
    public static function tby_showReceivingOrder($order_id)
    {
        try{
            $date=Order::join('business' ,'business.business_id' , 'order.business_id' )
                ->join('goods','goods.goods_id','order.goods_id')
                ->where('order.order_id',$order_id)
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到抢单总页面',[$e->getMessage()]);
        }
    }
    /**
     *抢单功能
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_catchReceivingOrder($request)
    {
        try{
            $date=Order::where('order_id',$request['order_id'])
            -> update(['rider_id'=>$request['rider_id']])
            ;
            return true;
        }catch(Exception $e){
            logger::Error('没有找到抢单成功',[$e->getMessage()]);
        }
    }
}
