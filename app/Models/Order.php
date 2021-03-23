<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;

class Order extends Model
{
    protected $table = "order";
    public $timestamps = true;
    protected $primaryKey = "order_id";
    protected $guarded = [];

    protected $fillable=['goods_id','goods_id'];





    /***
     * 当前商户所有订单
     * @param $business_id
     * @return |null
     */
    public static function tg_selectAll($business_id){
        try{
            $data = Order::join("goods","goods.goods_id","order.goods_id")
                ->where("order.business_id",$business_id)
                ->select("goods.price",
                    "goods.goods_id",
                    'goods.goods_name',
                    'order.order_id',
                    'goods.image_url')
                ->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }


    /***
     * 删除订单
     * @param $order_id
     * @return |null
     */
    public static function tg_delete($order_id){
        try{
            $data = Order::where("order_id",$order_id)->delete();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }

    /***
     *当前商户信息
     * @param $order_id
     * @return |null
     */

    public static function tg_select($order_id){
        try{
            $data = Order::select("*")->where("order_id",$order_id)->first();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 商家产看某一条评论的具体信息
     * @param $comment_id
     * @return |null
     */
    public static function tg_selectBusinessOrderInfo($comment_id){
        try{
            $data = Order::join("comment","comment.order_id","order.order_id")
                ->join("goods","goods.goods_id","order.goods_id")
                ->where("comment.comment_id",$comment_id)
                ->select("order.order_id",
                    "goods.goods_name",
                    "goods.image_url",
                    "order.total",
                    "goods.price",
                    "comment.attitude",
                    "comment.comment")
                ->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }


=======


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


    /*** 提交订单 将数据入库
     * @author zuoshengyu
     * @param $yonghu
     * @param $num
     * @param $bianhao
     * @param $total
     * @param $distance
     * @param $delivery
     * @param $time
     * @return null
     */
    public static function addorder($yonghu,$num,$bianhao,$total,$distance,$delivery,$time){

        try{
            $date=self::create(
                [
                    'user_id'=>$yonghu[0]->user_id,
                    'name'=>$yonghu[0]->name,
                    'address'=>$yonghu[0]->address,
                    'business_id'=>$bianhao[0]->business_id,
                    'goods_id'=>$bianhao[0]->goods_id,
                    'num'=>$num,
                    'distance'=>$distance,
                    'time'=>$time,
                    'delivery'=>$delivery,
                    'total'=>$total,
                    'type'=>'未付款'
                ]
            );

                   return $date;

        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }

    }


    /**
     * @param $order_id
     * @return null
     * @author zuoshengyu
     * 获取商品id 和 数量
     */
    public static  function  getGoods_idAndNum($order_id){
        try {
            $data = self::where('order_id',$order_id)
                ->select('num','goods_id')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商品id和数量失败',[$e->getMessage()]);
            return null;
        }
    }


    /***改变order表中订单状态
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function typechange($order_id){
        try {
            $data=self::where('order_id',$order_id)
            ->update([
                'type'=>'等待骑手接单'
            ]);
            return $data;
        }
    catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }
    }

    /***骑手取货改变订单状态
     * @author zsywx
     * @param $order_id
     * @return null
     */
    public static function typechangef($order_id){
        try {
            $data=self::where('order_id',$order_id)
                ->update([
                    'type'=>'派送中'
                ]);
            return $data;
        }
        catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }
    }


    /***未支付页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function nopayyemian($order_id){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.order_id','=',$order_id)
                ->select('order.order_id','order.time','order.distance','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }


    /***派送页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function paisongyemian($order_id){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->Join('rider','rider.rider_id','order.rider_id')
                ->where('order.order_id','=',$order_id)
                ->select('order.order_id','order.time','order.distance','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','rider.number')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***退款页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function tuikuanyemian($order_id){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->Join('rider','rider.rider_id','order.rider_id')
                ->where('order.order_id','=',$order_id)
                ->select('order.order_id','order.type','order.distance','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','rider.number')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }


    /***完成页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function finishyemian($order_id){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->Join('rider','rider.rider_id','order.rider_id')
                ->where('order.order_id','=',$order_id)
                ->select('order.order_id','order.updated_at','order.distance','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','rider.number')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***完成列表数据
     * @author zuoshengyu
     * @return null
     */
    public static function listorder(){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.type','=','已完成')
                ->select('order.order_id','business.name','goods.goods_name','goods.image_url','order.num')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***退款列表数据
     * @author zuoshengyu
     * @return null
     */
    public static function listorder2(){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.type','=','已退款')
                ->select('order.order_id','business.name','goods.goods_name','goods.image_url','order.num','order.type')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /***派送列表数据
     * @author zuoshengyu
     * @return null
     */
    public static function listorder3(){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.type','=','派送中')
                ->select('order.order_id','business.name','goods.goods_name','goods.image_url','order.num')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /***未付款页面数据
     * @author zuoshengyu
     * @return null
     */
    public static function listorder4(){

        try{
            $data = self::Join('business','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.type','=','未付款')
                ->select('order.order_id','business.name','goods.goods_name','goods.image_url','order.num')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***退单功能
     * @author zuoshengyu
     * @param $order_id
     * @param $reason
     * @return null
     */
    public static function tuidan($order_id,$reason){

        try{
            $data =self::where('order_id',$order_id)
            ->update([
               'type'=>'退款中',
               'reason'=>$reason
            ]);
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***订单状态改变
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function typechange2($order_id){
        try {
            $data=self::where('order_id',$order_id)
                ->update([
                    'type'=>'已完成'
                ]);

            return $data;
        }
        catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }
    }
    /***订单状态改变
     * @author zuoshengyu
     * @param $order_id
     * @return null
     */
    public static function typechangeb($order_id){
        try {
            $data=self::where('order_id',$order_id)
                ->update([
                    'type'=>'已退款'
                ]);

            return $data;
        }
        catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }
    }
    /*** 获取骑手订单
     * @param 骑手id
     * @return 订单列表
     */
    public static function listorder5($rider_id){
        try {
            $data = self::Join('business', 'business.business_id', 'order.business_id')
                ->Join('goods', 'goods.goods_id', 'order.goods_id')
                ->where('rider_id', '=', $rider_id)
                ->select('order.order_id', 'business.name', 'goods.goods_name', 'goods.image_url', 'order.num','business.name','goods.price','order.delivery')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取骑手订单列表错误',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * @param $order_id '订单id'
     * @return null '用户id和商家id'
     */
    public static  function getUser_idAndBusiness_id($order_id){
        try{
            $User_idAndBusiness_id= self::where('order.order_id','=',$order_id)
                ->select('business_id','user_id')
                ->get();
            return $User_idAndBusiness_id;
        }catch(\Exception $e){
            logError('获取订单信息错误',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手获取订单详情
     * @param '订单id'
     * @return null '订单详情'
     */
    public static  function riderorde($order_id){
        try {
            $data =
                self::Join('business', 'business.business_id', 'order.business_id')
                    ->Join('goods', 'goods.goods_id', 'order.goods_id')
                    ->where('order_id', '=', $order_id)
                    ->select('order.order_id', 'business.name', 'goods.goods_name', 'goods.image_url',
                        'order.num','business.name','goods.price','order.delivery','order.distance',
                        'order.address','business.address')
                    ->get();

            return $data;

        }catch(\Exception $e){
            logError('获取骑手订单列表错误',[$e->getMessage()]);
            return null;
        }


    }

}
