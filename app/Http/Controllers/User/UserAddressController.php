<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function Location(Request $request){
        $openid = $request['openid'];
        $data = User::tg_selectAddress($openid);
        if ($data != null){
            return json_success("查找成功",$data,200);
        }
        return json_fail("查找失败",$data,100);
    }



    public function DelAddress(Request $request){
        $openid = $request['openid'];
        $address = $request['address'];
        $data = User::tg_updateAddress($openid,$address);
        if ($data!=null){
            return json_success("查找成功",$data,200);
        }
        return json_fail("查找失败",$data,100);
    }
}
