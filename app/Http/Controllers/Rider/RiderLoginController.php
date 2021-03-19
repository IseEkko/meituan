<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiderLoginRequest;
use App\Http\Requests\RiderRequest;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;

class RiderLoginController extends Controller
{

    /**
     * 登录
     * @param Request $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(RiderLoginRequest  $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth('rider')->attempt($credentials)) {
                return json_fail(100, '账号或者用户名错误!', null);
            }
            return self::respondWithToken($token, '登陆成功!');
        } catch (\Exception $e) {
            echo $e->getMessage();
            return json_fail(500, '登陆失败!', null, 500);
        }
    }

    /**
     * 注销登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {

        }
        return auth()->check() ?
            json_fail('注销登陆失败!',null, 100 ) :
            json_success('注销登陆成功!',null,  200);
    }



    protected function credentials($request)
    {
        return ['email' => $request['email'], 'password' => $request['password']];
    }

    protected function respondWithToken($token, $msg)
    {
        return json_success( $msg, array(
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('rider')->factory()->getTTL() * 60
        ),200);
    }


    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(RiderRequest $registeredRequest)
    {
        return Rider::createUser(self::userHandle($registeredRequest)) ?
            json_success('注册成功!',null,200  ) :
            json_success('注册失败!',null,100  ) ;

    }
    protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['identity'] = $registeredInfo['identity'];
        $registeredInfo['name'] = $registeredInfo['name'];
        $registeredInfo['age'] = $registeredInfo['age'];
        $registeredInfo['gender'] = $registeredInfo['gender'];
        $registeredInfo['number'] = $registeredInfo['number'];
        $registeredInfo['region'] = $registeredInfo['region'];
        $registeredInfo['email'] = $registeredInfo['email'];
        $registeredInfo['approval'] = 100;
        $registeredInfo['real_approval'] = 100;

        return $registeredInfo;
    }
}
