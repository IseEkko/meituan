<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminCenterController extends Controller
{
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function showAdminMessage()
    {
      $data =  Admin::cwp_showAdminMessage();
      return $data?
           json_success('成功!',$data,200) :
           json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function alterAdminMessage(Request $request)
    {
        $data =  Admin::cwp_alterAdminMessage($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function showBusinessOperate()
    {
        $data =  Admin::cwp_showBusinessOperate();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function searchBusinessOperate(Request $request)
    {
        $data =  Admin::cwp_searchBusinessOperate($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderRealNameShowed()
    {
        $data =  Admin::cwp_riderRealNameShowed();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderRealNameShowing()
    {
        $data =  Admin::cwp_riderRealNameShowing();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderRealNamePass(Request $request)
    {
        $data =  Admin::cwp_riderRealNamePass($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function riderRealNameSearch(Request $request)
    {
        $data =  Admin::cwp_riderRealNameSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function businessRealNameShowed()
    {
        $data =  Admin::cwp_businessRealNameShowed();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function businessRealNameShowing()
    {
        $data =  Admin::cwp_businessRealNameShowing();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function businessRealNamePass(Request $request)
    {
        $data =  Admin::cwp_businessRealNamePass($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function businessRealNameSearch(Request $request)
    {
        $data =  Admin::cwp_businessRealNameSearch($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }
}
