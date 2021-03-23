<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Rider extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;

    public $table = 'rider';

    protected $rememberTokenName = NULL;

    protected $primaryKey = 'rider_id';

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
     * 创建骑手
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
     */
    public static function find($id){
        try {

            $pass = Rider::select('real_passing','passing')
                ->where('email',$id)
                ->get();
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('查询权限失败',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手头像获取
     * @param $id
     * @return false|null
     * @author lizhongzheng <github.com/bixuande>
     */
    public static function gettou($id){
        try {

            $pass = Rider::select('name','head_url')
                ->where('rider_id',$id)
                ->get();
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('查询权限失败',[$e->getMessage()]);
            return null;
        }

    }

    /***
     * 骑手头像修改
     * @param $request
     * @param $headpath
     * @param $id
     * @return false|null
      * @author lizhongzheng <github.com/bixuande>
     */
    public  static function updaretou($request,$headpath,$id){
        try {

            $pass = Rider::where('rider_id',$id)
                ->update([
                    'name' => $request['name'],
                    'head_url' => $headpath
                ]);
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('骑手头像获取失败',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手详情页展示
     * @param $id
     * @return false|null
     * @author lizhongzheng <github.com/bixuande>
     */
    public static function getRiderPer($id){
        try {
            $pass = Rider::where('rider_id',$id)
               ->select('number','gender','region','age')
                ->get();
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('骑手详情展示失败',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手详情修改
     * @param $req
     * @param $id
     * @return false|null
     * @author lizhongzheng <github.com/bixuande>
     */
    public static function updateper($req,$id){
        try {
            $pass = Rider::where('rider_id',$id)
               ->update([
                   'region' => $req['region'],
                   'number' => $req['number']
               ]);
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('骑手详情修改失败',[$e->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手钱包展示
     * @param $id
     * @return false|null
     * @author lizhongzheng <github.com/bixuande>
     */
    public static function showMoney($id){
        try {
            $pass = Rider::where('rider_id',$id)
               ->select('wallet')
                ->get();
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('骑手钱包展示失败',[$e->getMessage()]);
            return null;
        }
    }


    public static function updateRiderMoney($id,$money){
        try {
            $pass = Rider::where('rider_id',$id)
                ->update([
                    'wallet' => $money
                ]);
            return $pass ? $pass :false;
        } catch (\Exception $e) {
            logError('骑手详情修改失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function Pass($email){
        try {
            $res = self::where('email',$email)
                ->update([
                    'emailpass'=>200
                ]);
            return $res;
        }catch (\Exception $err){
            logError('骑手邮箱验证修改状态失败！', [$err->getMessage()]);
            return null;
        }
    }

    /***
     * 骑手修改密码
     * @param $req
     * @param $id
     * @return null
     */
    public static function updatePass($req,$id){
        try {

            $res = self::where('rider_id',$id)
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
