<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Super extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;

    public $table = 'super';

    protected $rememberTokenName = NULL;

    protected $primaryKey = 'id';

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
     * 创建超级管理员
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

    /**
     * @param $id
     * @return |null
     */
    public static function cwp_showSuperInfo($id)
    {
        try {
            $data = self::select('identity','name','number','gender')->where('id',$id)->get();
            return $data;
        } catch (\Exception $e) {
            logError('展示失败', [$e->getMessage()]);
            return null;
        }
    }


    /**
     * @param $data
     * @return |null
     */
    public static function cwp_alterSuperInfo($data)
    {
        try {
            $date = self::where('id', $data['id'])->update([
                'identity' => $data['identity'],
                'name' => $data['name'],
                'number' => $data['number'],
                'gender' => $data['gender']
            ]);
            return $date;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     *
     */
    public static function cwp_showAdminInfo()
    {
        try {
            $data = DB::table('admin')->select('admin_id','account','password','name','number','gender')->get();
            return $data;
        } catch (\Exception $e) {
            logError('查找失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $data
     * @return int|null
     */
    public static function cwp_alterAdminInfo($data)
    {
        try {
            $date = DB::table('admin')->where('admin_id', $data['adminId'])->update([
                'account' => $data['account'],
                'password' => $data['password'],
                'name' => $data['name'],
                'number' => $data['number'],
                'gender' => $data['gender']
            ]);
            return $date;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $data
     * @return int|null
     */
    public static function cwp_deleteAdminInfo($data)
    {
        try {
            $date = DB::table('admin')->where('admin_id', $data['adminId'])->delete();
            return $date;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $data
     * @return bool|null
     */
    public static function cwp_createAdminInfo($data)
    {
        try {
            $date = DB::table('admin')->insert([
                'admin_id'=>$data['adminId'],
                'account'=>$data['account'],
                'password'=>$data['password'],
                'name'=>$data['name'],
                'number'=>$data['number'],
                'gender'=>$data['gender']
            ]);
            return $date;
        } catch (\Exception $e) {
            logError('增加失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * @param $data
     * @return
     */
    public static function cwp_searchAdminInfo($data)
    {
        try {
            $date = DB::table('admin')->where('name','like','%'.$data['name'].'%')
                ->select('admin_id','account','password','name','number','gender')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }

    }


}
