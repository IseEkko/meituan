<?php

namespace App\Models;

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
     * 展示全部商家信息
     * @return |null
     */
    public static function tg_selectAll(){
        try{
            $data = Business::select("business_id",
            "shop_name",
            "identity",
            "name")->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }

    /***
     *
     * @param $type
     * @return |null
     */
    public static function tg_selectAllType($type){
        try{
            $data = Business::select("business_id",
                "shop_name",
                "identity",
                "name")->where("type",$type)->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }



    public static function tg_selectReMen(){
        try{
            $data = Business::select("image_url",
            "shop_name")->take(6)->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }



    public static function tg_selectBusinessById($business_id){
        try{

            $data = Business::where("business_id",$business_id)
                ->select("license",
                "shop_name",
                    'address',
                    'message',
                    'image_url'
                )
                ->get();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
}
