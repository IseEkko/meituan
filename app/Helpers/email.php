<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

if (!function_exists('email')) {
    /***
     *传入想发送的内容和邮箱，发送验证码，然后返回验证码
     * @param $email $ce
     * @return int
     */
    function email($ce, $email,$yong)
    {
          $em = $email;

        $zifu = "$ce$em ！";//这里可以修改发送的内容
        Mail::raw($zifu, function ($message) use ($email,$yong) {
            $to = "$email";
            $message->to($to)->subject($yong);
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        return $email;
    }
}

if (!function_exists('upload')) {
    /***
     *传入图片返回路径
     * @param $email $ce
     * @return int
     */
    function upload($pic)
    {

        $path = $pic->store('public');
        $res = str_replace('public/','storage/',$path);

        return $res;
    }
}
