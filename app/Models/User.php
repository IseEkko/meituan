<?php

namespace App\Models;
session_start();
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;


class User extends Model

{

    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "user_id";
    protected $guarded = [];

static $user=0;
static $random=0;


    public static function huoquyonghu($user_id){

    try{
        $data = self::select('name','number','address')
            ->where('user_id',$user_id)
            ->get();
        return $data;
    }catch(\Exception $e){
        logError('获取用户信息错误',[$e->getMessage()]);
        return null;
    }

}
    public static function huoquyonghu2($user_id){

        try{
            $data = self::select('name','number','address','user_id')
                ->where('user_id',$user_id)
                ->get();
            return $data;
        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
            return null;
        }

    }
    public static function suijijuli($user_id){

        if (!isset($_SESSION['user_id'] )and !isset($_SESSION['random'])) {
            $_SESSION['user_id']=0;
            $_SESSION['random'] =0;
        }

        if ($_SESSION['user_id']==$user_id){
            $data=$_SESSION['random'];
            return $data;
        }else{
            $_SESSION['user_id']=$user_id;
            $_SESSION['random']=random_int(700,1600);
            $data=$_SESSION['random'];
            return $data;
        }


    }
    public static function suijitime(){
        $data =  $data=$_SESSION['random'];;
        $data=$data+300;
        $data= date('i:s',$data);
        return $data;
    }
    public static function suijitime2(){
        $data =  $data=$_SESSION['random'];;
        $data=$data+300;

        return $data;
    }

    public static function suijimoney(){
        $data =  $data=$_SESSION['random'];;
        if ($data>1000){
            $money =3;
            return $money;
        }
        else{
            return $money=2;
        }
    }



}
