<?php

namespace App\Models;

use App\Http\Requests\BusinessLoginRequest;
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

    /***
     * 查询权限
     *  @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function find($id){
        try {

            $pass = Business::select('real_passing','passing')
                ->where('email',$id)
                ->get();

            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('查询权限失败',[$e->getMessage()]);
            return null;
        }
    }


    /***
     * 商家详情页展示
     * @author lizhongzheng <github.com/bixuande>
     *
     */
    public static function getBusIn($id){
        try {
            $res = self::select('image_url', 'license','shop_name','message','address','number','type')
                ->where('business_id', $id)
                ->get();
            return $res;
        } catch (\Exception $err) {
            logError('商家详情获取失败！', [$err->getMessage()]);
            return null;
        }
    }

    /***
     *   商家详情页修改
     * @author lizhongzheng <github.com/bixuande>
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $upda
     * @param $id
     * @return null
     */
    public static function UpdateBus($upda,$id){
        try {

            $res = self::where('business_id',$id)
                        ->update([
                            'shop_name'=>$upda['shop_name'],
                            'message'=>$upda['message'],
                            'address'=>$upda['address'],
                            'number'=>$upda['number']
                        ]);
            return $res;
        } catch (\Exception $err) {
            logError('商家详情获取失败！', [$err->getMessage()]);

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

    /***
     * 商家头像展示
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $id
     * @return null
     */
    public static function getTou($id){
        try {

            $res = self::where('business_id',$id)
            ->select('head_url','name')
            ->get();

            return $res;
        } catch (\Exception $err) {
            logError('商家头像获取失败！', [$err->getMessage()]);

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

    /***
     * 商家头像修改
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $req
     * @param $id
     * @return null
     */
    public static function upDateTou($req,$id,$path){
        try {
            $res = self::where('business_id',$id)
                ->update([
                    'head_url' => $path,
                    'name' => $req['name']
                ]);
                  return $res;
        }catch (\Exception $err){
            logError('商家头像修改失败！', [$err->getMessage()]);
            return null;
        }
    }

    /***
     * 商家钱包展示
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $id
     * @return null
     */
    public static function moneyShow($id){
        try {
            $res = self::where('business_id',$id)
               ->select('wallet')
            ->get();
            return $res;
        }catch (\Exception $err){
            logError('商家头像修改失败！', [$err->getMessage()]);
            return null;
        }
    }

    /***
     * 商家钱包充值
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $req
     * @param $id
     * @return null
     */
  public static function addMoney($req,$id){
      try {
          $res = self::where('business_id',$id)
             ->update([
                 'wallet' => $req
             ]);
          return $res;
      }catch (\Exception $err){
          logError('商家头像修改失败！', [$err->getMessage()]);
          return null;
      }
  }

    /***
     * 商家邮箱验证修改状态
     *  * @author lizhongzheng <github.com/bixuande>
     * @param $email
     * @return null
     */
  public static function Pass($email){
      try {
          $res = self::where('email',$email)
              ->update([
                  'emailpass'=>200
              ]);
          return $res;
      }catch (\Exception $err){
          logError('商家邮箱验证修改状态失败！', [$err->getMessage()]);
          return null;
      }
  }

    /***
     * 商家修改密码
     * @param $req
     * @param $id
     * @return null
     */
  public static function updatePass($req,$id){
      try {

          $res = self::where('business_id',$id)
              ->update([
                  'emailpass'=>100,
                  'password'=>$req
              ]);
          return $res;
      }catch (\Exception $err){
          logError('商家密码修改失败！', [$err->getMessage()]);
          return null;
      }
  }

}
