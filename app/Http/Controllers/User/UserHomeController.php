<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddMoneyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    /***
     * 用户钱包充值
     * @param UserAddMoneyRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
  public function userAddMoney(UserAddMoneyRequest $request){
      if($request['wallet']<0){
          return  json_fail('充值失败，充值金额不能为负！' , null, '100');
      }
      $old = User::selectUserMoney($request);
      $new = $old + $request['wallet'];
      $ad = User::addMoney($request,$new);
      return $ad ?
          json_success('用户充值成功！' , null, '200') :
          json_fail('用户充值失败！' , null, '100');
  }

    /***
     * 用户钱包展示
     * @param Request $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
  public function showMoney(Request $request){
      $money = User::showMoney($request);
      return $money ?
          json_success('用户钱包展示成功！' , $money, '200') :
          json_fail('用户钱包展示失败！' , null, '100');
  }


}
