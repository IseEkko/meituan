<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessManageAlterRequest;
use App\Http\Requests\Admin\GoodsManageAlterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class BusinessManageController extends Controller
{
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvalBusinessShowed()
    {
        $data =  Admin::cwp_approvalBusinessShowed();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function approvalBusinessShowing()
    {
        $data =  Admin::cwp_approvalBusinessShowing();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function approvalBusinessSearch(Request $request)
    {
        $data =  Admin::cwp_approvalBusinessSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);

    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function approvalBusinessPass(Request $request)
    {
        $data =  Admin::cwp_approvalBusinessPass($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessManageShow()
    {
        $data =  Admin::cwp_businessManageShow();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessManageAlter(BusinessManageAlterRequest $request)
    {
        $data =  Admin::cwp_businessManageAlter($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessManageDelete(Request $request)
    {
        $data =  Admin::cwp_businessManageDelete($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessManageDetail(Request $request)
    {
        $data =  Admin::cwp_businessManageDetail($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function businessManageSearch(Request $request)
    {
        $data =  Admin::cwp_businessManageSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvalGoodsShowed()
    {
        $data =  Admin::cwp_approvalGoodsShowed();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvalGoodsShowing()
    {
        $data =  Admin::cwp_approvalGoodsShowing();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvalGoodsSearch(Request $request)
    {
        $data =  Admin::cwp_approvalGoodsSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvalGoodsPass(Request $request)
    {
        $data =  Admin::cwp_approvalGoodsPass($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodsManageShow()
    {
        $data =  Admin::cwp_goodsManageShow();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodsManageAlter(GoodsManageAlterRequest $request)
    {
        $data =  Admin::cwp_goodsManageAlter($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodsManageDelete(Request $request)
    {
        $data =  Admin::cwp_goodsManageDelete($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodsManageSearch(Request $request)
    {
        $data =  Admin::cwp_goodsManageSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

}
