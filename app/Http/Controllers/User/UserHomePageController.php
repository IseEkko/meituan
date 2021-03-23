<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Goods;
use App\Models\User;
use Illuminate\Http\Request;

class UserHomePageController extends Controller
{
    /**
     * @Description 轮播图
     * @author tangguo
     */
    public function ShowLunBo(){
        $dataAll=Goods::tg_selectLunBo();
        $data=null;
        if ($dataAll != null){
            for ($i = 0; $i<count($dataAll);$i++){
                $data[$i]['image_url']=$dataAll[$i]['image_url'];
            }
            return json_success("查找成功",$data,200);
        }
        return json_fail("查找失败",$data,100);

    }

    /**
     * @Description 用户首页展示全部商家信息
     * @author tangguo
     */
    public function ShowAll(Request $request){
        $type=$request["type"];
        if ($type=="展示全部"){
            $dataAll=Business::tg_selectAll();
        }else{
            $dataAll=Business::tg_selectAllType($type);
        }
        $data=null;
        if($dataAll!=null){
            for ($i = 0; $i<count($dataAll);$i++){
                $data[$i]['business_id']=$dataAll[$i]['business_id'];
                $data[$i]['shop_name']=$dataAll[$i]['shop_name'];
                $data[$i]['identity']=$dataAll[$i]['identity'];
                $data[$i]['name']=$dataAll[$i]['name'];
            }
            return json_success("查找成功",$data,200);
        }

        return json_fail("查找失败",$data,100);
    }


    /**
     * @Description 热门推荐
     * @author tangguo
     */
    public function ShowReMen(){
            $dataAll=Business::tg_selectReMen();

            $data=null;
            if ($dataAll != null){
                for ($i = 0; $i<count($dataAll);$i++){
                    $data[$i]['image_url']=$dataAll[$i]['image_url'];
                    $data[$i]['shop_name']=$dataAll[$i]['shop_name'];
                }
                return json_success("查找成功",$data,200);
            }
            return json_fail("查找失败",$data,100);

        }



}
