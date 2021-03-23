<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Business extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;

    public $table = 'business';

    protected $rememberTokenName = NULL;

    protected $primaryKey = 'business_id';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTIdentifier()
    {
        return self::getKey();
    }

    /**
     * 创建商家
     *
     * @param array $array
     * @return |null
     * @throws Exception
     */
    public static function createUser($array = [])
    {
        try {
            return self::create($array) ?
                true :
                false;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }

    /***获取退款列表数据
     * @author zuoshengyu
     * @return json
     */
    public static function tuilist(){

        try{
            $data = self::Join('order','order.business_id','business.business_id')
                ->where('order.type','=','退款中')
                ->select('order.order_id','order.updated_at','order.name','order.total')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***获取退款页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return json
     */
    public static function tuiye($order_id){

        try{
            $data = self::Join('order','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.order_id',$order_id)
                ->select('order.order_id','order.updated_at','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','order.reason')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /***获取已完成页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return json
     */
    public static function finishye($order_id){

        try{
            $data = self::Join('order','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->where('order.order_id',$order_id)
                ->select('order.order_id','order.created_at','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','order.time')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***获取派送列表数据
     * @author zuoshengyu
     * @return json
     */
    public static function paylist(){

        try{
            $data = self::Join('order','order.business_id','business.business_id')
                ->where('order.type','=','派送中')
                ->select('order.order_id','order.updated_at','order.name','order.total')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }

    /***获取已完成列表数据
     * @author zuoshengyu
     * @return json
     */
    public static function finishlist(){

        try{
            $data = self::Join('order','order.business_id','business.business_id')
                ->where('order.type','=','已完成')
                ->select('order.order_id','order.updated_at','order.name','order.total')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /***获取派送页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return json
     */
    public static function paiye($order_id){

        try{
            $data = self::Join('order','business.business_id','order.business_id')
                ->Join('goods','goods.goods_id','order.goods_id')
                ->Join('rider','rider.rider_id','order.rider_id')
                ->where('order.order_id',$order_id)
                ->select('order.order_id','business.name','goods.goods_name','goods.image_url','goods.price','order.delivery','order.total','rider.number')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
    /***获取派送页面数据
     * @author zuoshengyu
     * @param $order_id
     * @return json
     */
    public static function tui($order_id){

        try{
            $data = self::Join('order','order.business_id','business.business_id')
                ->where('order.order_id','=',$order_id)
                ->select('order.order_id','order.updated_at','order.name','order.total')
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取商家商品信息错误',[$e->getMessage()]);
            return null;
        }

    }
}
