<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMoneyRequest;
use App\Http\Requests\BusinessUpdatePasswordRequest;
use App\Http\Requests\BusinessUpdateTouRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class BusinessHomeController extends Controller
{
    /***
     * 商家详情页展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    Public static function getBusInFo(){
        $id = auth('business')->user()->business_id;
        $HuoQu  = Business::getBusIn($id);
        return $HuoQu ?
            json_success('商家信息获取成功！' , $HuoQu, '200') :
            json_fail('商家信息获取失败！' , null, '100');

    }

    /***
     * 商家详情修改
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function upDateInFo(UpdateBusRequest $request){
        $id = auth('business')->user()->business_id;
         $update = Business::UpdateBus($request,$id);
        return $update ?
            json_success('商家信息修改成功！' , null, '200') :
            json_fail('商家信息修改失败！' , null, '100');
    }

    /***
     * 商家头像展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function getTou(){
        $id = auth('business')->user()->business_id;
        $update = Business::getTou($id);
        return $update ?
            json_success('商家头像展示成功！' , $update, '200') :
            json_fail('商家头像展示失败！' , null, '100');
    }
    /***
     * 商家头像修改
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function upDateTou(BusinessUpdateTouRequest $request){
          $id = auth('business')->user()->business_id;

          $path = upload($request['head_url']);
          $pathth = "http://127.0.0.1:8000/$path";
              $update = Business::upDateTou($request,$id,$pathth);
        return $update ?
            json_success('商家头像修改成功！' , $update, '200') :
            json_fail('商家头像修改失败！' , null, '100');
    }

    /***
     * 商家金额展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function moneyShow(){
        $id = auth('business')->user()->business_id;
        $show = Business::moneyShow($id);
        return $show ?
        json_success('商家钱包展示成功！' , $show, '200') :
            json_fail('商家钱包展示失败！' , null, '100');
    }

    /***
     * 商家充值钱包
     * @param AddMoneyRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function addMoney(AddMoneyRequest $request){
       if($request['wallet']<0){
         return  json_fail('充值失败充值不能为负数' , null, '100');
       }
        $money = auth('business')->user()->wallet;
        $id = auth('business')->user()->business_id;
       $new = $money+$request['wallet'];
       $add  = Business::addMoney($new,$id);
        return $add ?
            json_success('商家钱包充值成功！' , null, '200') :
            json_fail('商家钱包充值失败！' , null, '100');
    }

    /***
     * 商家邮箱验证发送
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static  function emailPass(){

        $Busemails = auth('business')->user()->email;

        $path = "请点击下面链接完成密码修改验证：http://127.0.0.1:8000/api/bushome/pass?email=";
        $email  =  email($path,$Busemails,'美团美团密码修改验证信息');
        return $email ?
            json_success('商家验证发送成功！' , null, '200') :
            json_fail('商家验证发送失败！' , null, '100');
    }

    /***
     * 修改验证状态
     * @param Request $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function Pass(Request $request){

        $email = Business::Pass($request['email']);
        return $email ?
            json_success('商家邮箱验证成功！' , null, '200') :
            json_fail('商家邮箱验证失败！' , null, '100');
    }

    /***
     * 商家修改密码
     * @param BusinessUpdatePasswordRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function updatePass(BusinessUpdatePasswordRequest  $request){
        if(auth('business')->user()->emailpass==100){
            return json_fail(100, '验证未完成!', null);
        }
        $id = auth('business')->user()->business_id;
        $pass = bcrypt($request['password']);
        $pas = Business::updatePass($pass,$id);
        return $pas ?
            json_success('商家密码修改成功！' , null, '200') :
            json_fail('商家密码修改失败！' , null, '100');
    }

}
