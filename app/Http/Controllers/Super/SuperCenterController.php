<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\Super\alterAdminInfoRequest;
use App\Http\Requests\Super\alterSuperInfoRequest;
use App\Models\Super;
use Illuminate\Http\Request;

class SuperCenterController extends Controller
{
    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function showSuperInfo()
    {
        $id = $_GET['id'];
        $data = Super::cwp_showSuperInfo($id);
       return $data?
           json_success('成功!',$data,200) :
           json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function alterSuperInfo(alterSuperInfoRequest $request)
    {
       $data = Super::cwp_alterSuperInfo($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
	Public function showAdminInfo()
    {

        $data = Super::cwp_showAdminInfo();
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function alterAdminInfo(alterAdminInfoRequest $request)
    {
        $data = Super::cwp_alterAdminInfo($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);

    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function deleteAdminInfo(Request $request)
    {
        $data = Super::cwp_deleteAdminInfo($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function createAdminInfo(Request $request)
    {
        $data = Super::cwp_createAdminInfo($request);
        return $data?
            json_success('成功!',null,200) :
            json_fail('失败!',null,100);
    }

    /**
     * @author caiwenpin <github.com/codercwp>
     * @return \Illuminate\Http\JsonResponse
     */
    Public function searchAdminInfo(Request $request)
    {
        $data = Super::cwp_searchAdminInfo($request);
        return $data?
            json_success('成功!',$data,200) :
            json_fail('失败!',null,100);
    }


}
