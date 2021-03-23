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

    /**
     *
     */
    public static function tg_selectLunBo()
    {
        try {
            $data = Goods::select("image_url")->take(4)->get();
            return $data;
        } catch (\Exception $e) {
            logError("查找失败", [$e->getMessage()]);
            return null;
        }
    }



    /***
     *
     * @param $id
     * @return |null
     */
    public static function tg_selectGoodsById($id)
    {
        try {
            //$data =Goods::all();
            $data = Goods::select("*")->where('business_id', $id)->get();

            return $data;
        } catch (\Exception $e) {
            logError("查找失败", [$e->getMessage()]);



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


    /***
     * 商家上新产品
     * @param $req
     * @param $path
     * @return |null
     */
    public static function AddGoods_tg($req, $path,$business_id)
        {
            try {
                $data = Goods::create([
                    'goods_name' => $req['goods_name'],
                    'price' => $req['price'],
                    'approval' => 100,
                    'passing' => 100,
                    'business_id'=>$business_id,
                    'image_url' => $path,
                    'category'=>"上新"
                ]);
                return $data;
            } catch (\Exception $e) {
                logError("添加上新商品失败", [$e->getMessage()]);
                return null;
            }
        }

    /***
     * 商家上新热销产品
     * @param $req
     * @param $path
     * @param $business_id
     * @return |null
     */
    public static function tg_AddGoodsReXiao($req,$path,$business_id)
    {
        try {
            $data = Goods::create([
                'goods_name' => $req['goods_name'],
                'price' => $req['price'],
                'approval' => 100,
                'passing' => 100,
                'business_id'=>$business_id,
                'image_url' => $path,
                'category'=>"热销产品"
            ]);
            return $data;
        }catch (\Exception $e){
            logError("添加热销产品商品失败", [$e->getMessage()]);
            return null;
        }

    }
    /***
     * 商家上新优惠产品
     * @param $req
     * @param $path
     * @param $business_id
     * @return |null
     */
    public static function tg_AddGoodsYouHui($req,$path,$business_id)
    {
        try {
            $data = Goods::create([
                'goods_name' => $req['goods_name'],
                'price' => $req['price'],
                'approval' => 100,
                'passing' => 100,
                'business_id'=>$business_id,
                'image_url' => $path,
                'category'=>"优惠产品"
            ]);
            return $data;
        }catch (\Exception $e){
            logError("添加优惠产品商品失败", [$e->getMessage()]);
            return null;
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
