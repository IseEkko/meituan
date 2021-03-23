<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class Goods extends Model
{
    protected $table = "goods";
    public $timestamps = true;
    protected $primaryKey = "goods_id";
    protected $guarded = [];



//   xx
    public static function huoqusjsp($goods_id){

        try{
            $data = self::Join('business','business.business_id','goods.business_id')
                ->where('goods.goods_Id','=',$goods_id)
                ->select('business.shop_name','goods.goods_name','goods.image_url','price')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    public static function gtotal($goods_id){


        try{
            $data=DB::table('goods')
                ->where('goods_id',$goods_id)
                ->value('price');
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }
    }

    public static function huoqu($goods_id){

        try{
            $data = self::Join('business','business.business_id','goods.business_id')
                ->where('goods.goods_id','=',$goods_id)
                ->select('business.business_id','goods.goods_id')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /**
     * 增加商品销量
     * @param $num '数量'
     * @param $goods_id '商品id'
     * @return null
     */
    public static function addGoods_num($num,$goods_id){
        try {
            $data=self::where('goods_id',$goods_id)
                ->increment('num',2);
            return $data;
        }
        catch(\Exception $e){
            logError('销量增加失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * //减少商品销量
     * @param $num'数量'
     * @param $goods_id '商品id'
     * @return null
     */
    public static function reduceGoods_num($num,$goods_id){
        try {
            $data=self::where('goods_id','=',$goods_id)
                ->decrement('num',$num);
            return $data;
        }
        catch(\Exception $e){
            logError('销量减少失败',[$e->getMessage()]);
            return null;
        }
    }
}
