<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "user_id";
    protected $guarded = [];


    public static function tg_selectAddress($openid){
        try{
            $data = Self::select("name","number")->where("openid",$openid)->first();
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
    public static function tg_updateAddress($openid,$address){
        try{
            $data = User::where("openid",$openid)->update(['address'=>$address]);
            return $data;
        }catch (\Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
}
