<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Comment;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Http\Request;

class BusinessUserController extends Controller
{
    //
    public function ShowAll(){
        $business_id = auth('business')->user()->business_id;
        $dataAll = Order::tg_selectAll($business_id);
        $data = null;
        if ($dataAll!=null){
                for ($i = 0; $i<count($dataAll);$i++){
                    $data[$i]['goods_id']=$dataAll[$i]['goods_id'];
                    $data[$i]['price']=$dataAll[$i]['price'];
                    $data[$i]['goods_name']=$dataAll[$i]['goods_name'];
                    $data[$i]['order_id']=$dataAll[$i]['order_id'];
                    $data[$i]['image_url']=$dataAll[$i]['image_url'];
                }
                return json_success("查找成功",$data,200);
            }
            return json_fail("查找失败",$data,100);
    }

    /***
     * 删除当前订单
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $data = Order::tg_delete($request['order_id']);

        if ($data !=null){

            return json_success("删除成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }


    /***
     * 当前商户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ShowInfo(Request $request){
        $data = Order::tg_select($request['order_id']);

        if ($data !=null){

            return json_success("查找成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }

    /***
     * 当前商品评价
     * @author tangguo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pingjia(Request $request){
        $data = Comment::tg_selectAll($request['order_id']);

        if ($data !=null){

            return json_success("查看成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }

    /***
     * 商家简介
     * @author tangguo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function BusinessOrderInfo(Request $request){

        $data = Order::tg_selectBusinessOrderInfo($request['comment_id']);

        if ($data !=null){

            return json_success("查找成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }

    /***
     * 当前店铺中评价详情
     * @author tangguo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ShowXiangQing(Request $request){
        $data = Comment::tg_selectpingjia($request['business_id']);

        if ($data !=null){

            return json_success("查找成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }

    /***
     * 商家产看某一条评论的具体信息
     * @author tangguo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ShowBusinessInfo(Request $request){
        $data = Business::tg_selectBusinessById($request["business_id"]);
        if ($data !=null){
            return json_success("查找成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }

    /***
     * 商家上新产品
     * @author tangguo <github/>
     * @param Request $request
     * @return null
     */
     public function AddGoodsNew(Request $request){
         $business_id = auth('business')->user()->business_id;
         $path = upload($request['image_url']);
         $newpath = "http://127.0.0.1:8000/$path";
         $good = Goods::AddGoods_tg($request,$newpath,$business_id);
            return $good?
           json_success("商家上新产品成功",null,200):
           json_fail("商家上新产品失败",null,100);
     }
    /***
     * 商家上新热销产品
     * @author tangguo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AddGoodsReXiao(Request $request){
        $business_id = auth('business')->user()->business_id;
        $path = upload($request['image_url']);
        $newpath = "http://127.0.0.1:8000/$path";
        $good = Goods::tg_AddGoodsReXiao($request,$newpath,$business_id);
        return $good?
            json_success("商家上新热销产品成功",null,200):
            json_fail("商家上新热销产品失败",null,100);
    }
    public function AddGoodsYouHui(Request $request){
        $business_id = auth('business')->user()->business_id;
        $path = upload($request['image_url']);
        $newpath = "http://127.0.0.1:8000/$path";
        $good = Goods::tg_AddGoodsYouHui($request,$newpath,$business_id);
        return $good?
            json_success("商家上新优惠产品成功",null,200):
            json_fail("商家上新优惠产品失败",null,100);
    }
}
