<?php

namespace App\Models;

session_start();
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;





use Illuminate\Http\Request;



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




    /***
     * 增加用户composer require encore/laravel-admin:1.*
     * @author lizhongzheng <github.com/bixuande>
     * @return null
     */
    public static function addUser($data)
    {
        try {
            $goods = User::create([
                'openid' => $data['openid'],
                'name' => $data['name']
            ]);
            return $goods;
        } catch (\Exception $e) {
            logError('添加用户失败', [$e->getMessage()]);
            return null;
        }
    }

    /***
     * 查询用户钱包金额
     * @param $req
     * @author lizhongzheng <github.com/bixuande>
     * @return null
     */
    public static function selectUserMoney($req){
        try {
            $goods = User::where('openid',$req['openid'])
              ->select('wallet');
            return $goods;
        } catch (\Exception $e) {
            logError('查询用户余额失败', [$e->getMessage()]);
            return null;
        }
    }

    /***
     * 用户充值钱包
     * @param $req
     * @param $new
     * @return null
     */
    public static function addMoney($req,$new){
        try {
            $goods = User::where('openid',$req['openid'])
                ->create([
                    'wallet' => $new
                ]);
            return $goods;
        } catch (\Exception $e) {
            logError('用户充值失败', [$e->getMessage()]);
            return null;
        }
    }
    /***
 * 查询用户钱包金额
 * @param $req
 * @author lizhongzheng <github.com/bixuande>
 * @return null
 */
    public static function showMoney($req){
        try {
            $goods = User::where('openid',$req['openid'])
                ->select('wallet')
            ->get();
            return $goods;
        } catch (\Exception $e) {
            logError('查询用户余额失败', [$e->getMessage()]);
            return null;
        }
    }

}
