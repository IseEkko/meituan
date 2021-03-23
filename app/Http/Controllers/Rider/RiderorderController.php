<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\RiderorderlistRequest;
use App\Http\Requests\RiderorderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class RiderorderController extends Controller
{
    /***
     * 获取骑手订单列表
     * @author zuoshengyuwx
     * @param RiderorderlistRequest $request
     * @return json
     */
    public function riderorderlist(RiderorderlistRequest $request)
    {
        $rider_id = $request->get('rider_id');
        $date = Order::listorder5($rider_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }

    /***
     * 联系商家
     * @author zuoshengyuwx
     * @return json
     */
    public  function rcallbusiness(){
        $date = "联系成功";
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }

    /****
     * 联系用户
     * @author zuoshengyuwx
     * @return json
     */
    public function rcalluser(){
        $date = "联系成功";
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }

    /***
     * 获取骑手订单详情
     * @author zuoshengyuwx
     * @param RiderorderRequest $request
     * @return json
     */
    public function riderorder(RiderorderRequest $request){
        $order_id = $request->get('order_id');
        $date = Order::riderorde($order_id);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }
}
