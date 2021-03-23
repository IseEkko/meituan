<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

//    public static function tg_selectGoods(){
//        try{
//            $data = Goods::selectGoods("image_url",
//                "shop_name",
//                "price",
//                "name")->get();
//            return $data;
//        }catch (\Exception $e){
//            logError("查找失败",[$e->getMessage()]);
//            return null;
//        }
//    }

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

    }
}
