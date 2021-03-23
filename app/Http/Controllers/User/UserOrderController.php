<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Order;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function QuiryGoods(Request $request){

        $id = $request['business_id'];
        $data =  Goods::tg_selectGoodsById($id);
        if($data!=null){
            return json_success("查找成功",$data,200);
        }else{
            return json_fail("查询失败",$data,100);
        }
    }

//    public function DianCanGoods(Request $request){
//        $orderInfo['goods_id'] = $request['goods_id'];
//        $orderInfo['num'] = $request['num'];
//        $orderInfo['total'] = $request['total'];
//        $orderInfo['address'] = $request['address'];
//        $orderInfo['name'] = $request['name'];
//        $orderInfo['time'] = $request['time'];
//        $orderInfo['delivery'] = $request['delivery'];
//        $record = Order::tg_chaRuGoods($orderInfo);
//        if ($record){
//            return json_success("插入成功",null,200);
//        }else{
//            return json_fail("插入失败",null,100);
//        }
//    }



    public function PingJiaGoods(){
        $business_id = auth('business')->user()->$business_id;
        $dataAll = comment::tg_selectpingjia($business_id);
        $data = null;
        if ($dataAll!=null){
            for ($i = 0; $i<count($dataAll);$i++){
                $data[$i]['business_id']=$dataAll[$i]['goods_id'];
                $data[$i]['price']=$dataAll[$i]['price'];
                $data[$i]['goods_name']=$dataAll[$i]['goods_name'];
                $data[$i]['order_id']=$dataAll[$i]['order_id'];
                $data[$i]['image_url']=$dataAll[$i]['image_url'];
            }
            return json_success("查找成功",$data,200);
        }
        return json_fail("查找失败",$data,100);
    }
}
