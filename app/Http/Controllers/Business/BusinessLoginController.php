<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessLoginRequest;
use App\Http\Requests\BusinessRequest;
use App\Models\Business;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;



class BusinessLoginController extends Controller
{

    /**
     * 登录
     * @param Request $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(BusinessLoginRequest $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);

            if (!$token = auth('business')->attempt($credentials)) {
                return json_fail(100, '账号或者用户名错误!', null);
            }else{
                //转换两次才能使用
                $passing= Business::find($loginRequest['email']);
                $pass = json_encode($passing);
                $pass = json_decode($pass);
                if (!($pass[0]->real_passing==200&&$pass[0]->passing==200)){
                    return json_fail(100, '验证未完成!', null);
                }
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
            'expires_in' => auth('business')->factory()->getTTL() * 60
        ),200);
    }


    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(BusinessRequest $registeredRequest)
    {
        return Business::createUser(self::userHandle($registeredRequest)) ?
            json_success('注册成功!',null,200  ) :
            json_success('注册失败!',null,100  ) ;

    }
    protected function userHandle($request)
    {
        $path = upload($request['image_url']);
        $pathth = "http://127.0.0.1:8000/$path";
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['identity'] = $registeredInfo['identity'];
        $registeredInfo['name'] = $registeredInfo['name'];
        $registeredInfo['shop_name'] = $registeredInfo['shop_name'];
        $registeredInfo['license'] = $registeredInfo['license'];
        $registeredInfo['message'] = $registeredInfo['message'];
        $registeredInfo['address'] = $registeredInfo['address'];
        $registeredInfo['image_url'] = $pathth;
        $registeredInfo['type'] = $registeredInfo['type'];
        $registeredInfo['number'] = $registeredInfo['number'];
        $registeredInfo['email'] = $registeredInfo['email'];
        $registeredInfo['approval'] = 100;
        $registeredInfo['real_approval'] = 100;
        $registeredInfo['passing'] = 100;
        $registeredInfo['real_passing'] = 100;
        return $registeredInfo;
    }



}
