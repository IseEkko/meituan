<?php

namespace App\Models;

use App\Http\Requests\BusinessLoginRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
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
