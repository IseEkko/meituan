<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatchReceivingOrder;
use App\Http\Requests\ShowReceivingOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class RiderReceivingOrderController extends Controller
{
    /**
     *展示订单页面所有
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showReceivingOrderAll()
    {


        $date = Order::tby_showReceivingOrderAll();
        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *展示抢单对应页面
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showReceivingOrder(ShowReceivingOrder $request)
    {


        $date = Order::tby_showReceivingOrder($request['order_id']);

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     *骑手抢单功能
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
    public function catchReceivingOrder(CatchReceivingOrder $request)
    {


        $date = Order::tby_catchReceivingOrder($request);

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

}
