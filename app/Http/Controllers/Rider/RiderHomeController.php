<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessUpdatePasswordRequest;
use App\Http\Requests\UpdateRiderMoneyRequest;
use App\Http\Requests\UpdateRiderPasswordRequest;
use App\Http\Requests\UpdateRiderperRequest;
use App\Http\Requests\UpdateRiderRequest;
use App\Models\Business;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderHomeController extends Controller
{
    /***
     * 骑手头像展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public function getRiderTou(){

        $id = auth('rider')->user()->rider_id;
        $tou = Rider::gettou($id);
        return $tou ?
            json_success('骑手头像成功！' , $tou, '200') :
            json_fail('骑手头像失败！' , null, '100');
    }

    /***
     * 骑手头像修改
     * @author lizhongzheng <github.com/bixuande>
     * @param UpdateRiderRequest $request
     * @return json
     */
    public function updateTou(UpdateRiderRequest $request){
        $id = auth('rider')->user()->rider_id;
        $path = upload($request['head_url']);
        $headpath = "http://127.0.0.1:8000/$path";
        $tou = Rider::updaretou($request,$headpath,$id);
        return $tou ?
            json_success('修改骑手头像成功！' , null, '200') :
            json_fail('修改骑手头像失败！' , null, '100');
    }

    /***
     * 骑手详情展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function getRiderperson(){
        $id = auth('rider')->user()->rider_id;
        $per = Rider::getRiderPer($id);
        return $per ?
            json_success('骑手详情展示成功！' , $per, '200') :
            json_fail('骑手详情展示失败！' , null, '100');
    }

    /***
     * 骑手详情修改
     * @param UpdateRiderperRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function updateRider(UpdateRiderperRequest $request){
        $id = auth('rider')->user()->rider_id;
        $per = Rider::updateper($request,$id);
        return $per ?
            json_success('骑手详情修改成功！' , null, '200') :
            json_fail('骑手详情修改失败！' , null, '100');
    }

    /***
     * 骑手钱包展示
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function showRiderMoney(){
        $id = auth('rider')->user()->rider_id;
         $money = Rider::showMoney($id);
        return $money ?
            json_success('骑手钱包展示成功！' , $money, '200') :
            json_fail('骑手钱包展示失败！' , null, '100');
    }

    /***
     * 骑手钱包充值
     * @param UpdateRiderMoneyRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function updateRiderMoney(UpdateRiderMoneyRequest $request){
        if($request['wallet']<0){
         return   json_fail('骑手钱包充值失败,充值不能为负！' , null, '100');
        }
        $id = auth('rider')->user()->rider_id;
        $mon = auth('rider')->user()->wallet;
        $moneyy = $mon+$request['wallet'];
        $money = Rider::updateRiderMoney($id,$moneyy);
        return $money ?
            json_success('骑手钱包充值成功！' , null, '200') :
            json_fail('骑手钱包充值失败！' , null, '100');
    }

    /***
     * 骑手邮箱验证发送
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function riderEmail(){
        $email = auth('rider')->user()->email;
        $message = "http://127.0.0.1:8000/api/riderhome/pass?email=";
       $money =  email($message,$email,'美团美团邮箱验证');
        return $money ?
            json_success('骑手邮箱验证发送成功！' , null, '200') :
            json_fail('骑手邮箱验证发送失败！' , null, '100');
    }

    /***
     * 修改验证状态
     * @param Request $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function Pass(Request $request){

        $email = Rider::Pass($request['email']);
        return $email ?
            json_success('骑手邮箱验证成功！' , null, '200') :
            json_fail('骑手邮箱验证失败！' , null, '100');
    }

    /***
     * 骑手修改密码
     * @param BusinessUpdatePasswordRequest $request
     * @author lizhongzheng <github.com/bixuande>
     * @return json
     */
    public static function updatePass(UpdateRiderPasswordRequest  $request){
        if(auth('rider')->user()->emailpass==100){
            return json_fail(100, '验证未完成!', null);
        }
        $id = auth('rider')->user()->rider_id;
        $pass = bcrypt($request['password']);
        $pas = Rider::updatePass($pass,$id);
        return $pas ?
            json_success('骑手密码修改成功！' , null, '200') :
            json_fail('骑手密码修改失败！' , null, '100');
    }

}
