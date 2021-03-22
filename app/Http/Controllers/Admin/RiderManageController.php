<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RiderManageAlterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class RiderManageController extends Controller
{
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function approvalRiderShowed()
    {
        $data =  Admin::cwp_approvalRiderShowed();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function approvalRiderShowing()
    {
        $data =  Admin::cwp_approvalRiderShowing();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function approvalRiderSearch(Request $request)
    {
        $data =  Admin::cwp_approvalRiderSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function approvalRiderPass(Request $request)
    {
        $data =  Admin::cwp_approvalRiderPass($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderManageShow()
    {
        $data =  Admin::cwp_riderManageShow();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderManageAlter(RiderManageAlterRequest $request)
    {
        $data =  Admin::cwp_riderManageAlter($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderManageDelete(Request $request)
    {
        $data =  Admin::cwp_riderManageDelete($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderManageSearch(Request $request)
    {
        $data =  Admin::cwp_riderManageSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
}
