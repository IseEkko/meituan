<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User extends Model
{
    protected $table = "user";
    public $timestamps = true;
    protected $primaryKey = "user_id";
    protected $guarded = [];

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
