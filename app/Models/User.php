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


    /***获取用户姓名电话地址
     * @author zuoshengyu
     * @param $user_id
     * @return null
     */
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
    /***获取用户姓名电话地址 id
     * @author zuoshengyu
     * @param $user_id
     * @return null
     */
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

    /***随机距离 根据不同id来随机判断
     * @param $user_id
     * @return int|mixed
     * @throws \Exception
     */
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
    /***根据距离 预计算时间并改变格式

     * @return int|mixed
     * @throws \Exception
     */
    public static function suijitime(){
        $data =  $data=$_SESSION['random'];;
        $data=$data+300;
        $data= date('i:s',$data);
        return $data;
    }
    /***根据距离 预计算时间
     * @return int|mixed
     * @throws \Exception
     */
    public static function suijitime2(){
        $data =  $data=$_SESSION['random'];;
        $data=$data+300;

        return $data;
    }
    /***根据距离 预计算配送费

     * @return int|mixed
     * @throws \Exception
     */
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
