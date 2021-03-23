<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
