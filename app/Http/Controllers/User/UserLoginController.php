<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    /**
     * 获取微信用户详细信息
     * @param Request $request
     * ['code'] => 用户的code
     * @author LiZhongZheng <https://github.com/bixuande>
     * return json
     */
    public function getInfo(Request $request)
    {
        $code = $request['code'];
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wxaff39afcf4ab704d&secret=611082f442da431bf6692569ebc45635&js_code='.$code.'&grant_type=authorization_code';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $data = curl_exec($curl);
        curl_close($curl);
        if($data){
            return json_decode($data,true);
        }else{
            return json_fail('操作失败!',null,100);
        }
    }
    /***
     * 增加用户
     * @param AddUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser(AddUserRequest $request)
    {
        $userinfo = User::addUser($request);
        return $userinfo?
            json_success('添加用户成功',null,200):
            json_fail('添加用户失败',null,100);
    }



}
