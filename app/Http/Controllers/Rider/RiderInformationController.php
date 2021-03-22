<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowBusinessUserInformationAll;
use App\Http\Requests\ShowReceivingOrder;
use App\Http\Requests\ShowRiderBusinessInformation;
use App\Http\Requests\ShowRiderBusinessInformationAll;
use App\Http\Requests\ShowRiderUserInformation;
use App\Http\Requests\ShowRiderUserInformationAll;
use App\Http\Requests\ShowUserBusinessInformation;
use App\Http\Requests\ShowUserBusinessInformationAll;
use App\Http\Requests\TalkRiderBusinessInformation;
use App\Http\Requests\TalkRiderUserInformation;
use App\Http\Requests\TalkUserBusinessInformation;
use App\Models\Businessrider;
use App\Models\BusinessUser;
use App\Models\Order;
use App\Models\RiderUser;
use Illuminate\Http\Request;

class RiderInformationController extends Controller
{
    /**
     *展示骑手与用户和商家消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRiderUserInformationAll(ShowRiderUserInformationAll $request)
    {
          if($request['type_id'] == 1)
          {
              $date = RiderUser::tby_showRiderUserInformationAll($request);
          }
          else if($request['type_id'] == 2)
          {
              $date = Businessrider::tby_showRiderUserInformationAll($request);
          }


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *展示当前商家与用户和骑手消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showBusinessUserInformationAll(ShowBusinessUserInformationAll $request)
    {
          if($request['type_id'] == 1)
          {
              $date = BusinessUser::tby_showBusinessUserInformationAll($request);
          }
          else if($request['type_id'] == 2)
          {
              $date = Businessrider::tby_showBusinessUserInformationAll($request);
          }


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *展示当前用户与商家和骑手消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUserBusinessInformationAll(ShowUserBusinessInformationAll $request)
    {
        if($request['type_id'] == 1)
        {
            $date = RiderUser::tby_showUserBusinessInformationAll($request);
        }
        else if($request['type_id'] == 2)
        {
            $date = BusinessUser::tby_showUserBusinessInformationAll($request);
        }


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *展示当前骑手与用户对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRiderUserInformation(ShowRiderUserInformation $request)
    {

            $date = RiderUser::tby_showRiderUserInformation($request);



        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *展示当前骑手与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRiderBusinessInformation(ShowRiderBusinessInformation $request)
    {

            $date = Businessrider::tby_showRiderBusinessInformation($request);



        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     *展示当前用户与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUserBusinessInformation(ShowUserBusinessInformation $request)
    {

        $date = BusinessUser::tby_showUserBusinessInformation($request);



        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     *发送当前骑手与用户对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function talkRiderUserInformation(TalkRiderUserInformation $request)
    {

            $date = RiderUser::tby_talkRiderUserInformation($request);


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     *发送当前骑手与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function talkRiderBusinessInformation(TalkRiderBusinessInformation $request)
    {

        $date = Businessrider::tby_talkRiderBusinessInformation($request);


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     *发送当前骑手与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function talkUserBusinessInformation(TalkUserBusinessInformation $request)
    {

        $date = BusinessUser::tby_talkUserBusinessInformation($request);


        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
}
