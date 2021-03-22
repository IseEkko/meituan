<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends \Illuminate\Foundation\Auth\User implements JWTSubject,\Illuminate\Contracts\Auth\Authenticatable
{
    use Notifiable;

    public $table = 'admin';

    protected $rememberTokenName = NULL;

    protected $primaryKey = 'admin_id';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTIdentifier()
    {
        return self::getKey();
    }
    /**
     * 创建管理员
     *
     * @param array $array
     * @return |null
     * @throws Exception
     */
    public static function createUser($array = [])
    {
        try {

            return self::create($array) ?
                true :
                false;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_showAdminMessage()
    {
        try {
            $data = self::select('admin_id','name','number','gender')->get();
            return $data;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }


    public static function cwp_alterAdminMessage($param)
    {
        try {
            $date = self::where('admin_id', $param['adminId'])->update([
                'name' => $param['name'],
                'number' => $param['number'],
                'gender' => $param['gender']
            ]);
            return $date;
        } catch (\Exception $e) {
            logError('修改失败', [$e->getMessage()]);
            return null;
        }

    }


    public static function cwp_showBusinessOperate()
    {
        try {
            $data = DB::table('business')->join('goods as gs','business.business_id','gs.business_id')
                ->select('gs.goods_id','gs.goods_name','gs.price','business.name','gs.num')->get();
           return $data;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_searchBusinessOperate($param)
    {
        try {
            $data = DB::table('business')->join('goods as gs','business.business_id','gs.business_id')
                ->where('business.name','like','%'.$param['businessName'].'%')
                ->select('gs.goods_id','gs.goods_name','gs.price','business.name','gs.num')->get();
            return $data;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_riderRealNameShowed()
    {
        try {
            $data = DB::table('rider')->where('real_approval',200)
                ->select('rider_id','name','identity','real_passing')->get();
            return $data;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_riderRealNameShowing()
    {
        try {
            $data = DB::table('rider')->where('real_approval',100)
                ->select('rider_id','name','identity')->get();
            return $data;
        } catch (\Exception $e) {
            logError('失败',[$e->getMessage()]);
            return null;
        }
    }


    public static function cwp_riderRealNamePass($param)
    {
        if($param['code']==100){
            try {
                $data = DB::table('rider')->where('rider_id',$param['riderId'])
                    ->update([
                        'real_approval'=>200,
                        'real_passing'=> 100,
                        'real_reason' => $param['reason']
                    ]);
                return $data;
            } catch (\Exception $e) {
                logError('失败',[$e->getMessage()]);
                return null;
            }
        }
        if($param['code']==200){
            try {
                $data = DB::table('rider')->where('rider_id',$param['riderId'])
                    ->update([
                        'real_approval'=>200,
                        'real_passing'=> 200
                    ]);
                return $data;
            } catch (\Exception $e) {
                logError('失败',[$e->getMessage()]);
                return null;
            }
        }

    }


    public static function cwp_riderRealNameSearch($param)
    {
        try {
            $date = DB::table('rider')->where('name','like','%'.$param['riderName'].'%')
                ->select('rider_id','name','identity','real_passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_businessRealNameShowed()
    {
        try {
            $date = DB::table('business')->where('real_approval',200)->select('business_id','name','identity','real_passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_businessRealNameShowing()
    {
        try {
            $date = DB::table('business')->where('real_approval',100)->select('business_id','name','identity')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }


    public static function cwp_businessRealNamePass($param)
    {
        if($param['code']==100){
            try {
                $data = DB::table('business')->where('business_id',$param['businessId'])
                    ->update([
                        'real_approval'=> 200,
                        'real_passing'=> 100,
                        'real_reason' => $param['reason']
                    ]);
                return $data;
            } catch (\Exception $e) {
                logError('失败',[$e->getMessage()]);
                return null;
            }
        }
        if($param['code']==200){
            try {
                $data = DB::table('business')->where('business_id',$param['businessId'])
                    ->update([
                        'real_approval'=> 200,
                        'real_passing'=> 200
                    ]);
                return $data;
            } catch (\Exception $e) {
                logError('失败',[$e->getMessage()]);
                return null;
            }
        }
    }


    public static function cwp_businessRealNameSearch($param)
    {
        try {
            $date = DB::table('business')->where('name','like','%'.$param['businessName'].'%')
                ->select('business_id','name','identity','real_passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }


    public static function cwp_approvalBusinessShowed()
    {
        try {
            $date = DB::table('business')->where('approval',200)
                ->select('business_id','shop_name','license','image_url','type','message','address','number','passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalBusinessShowing()
    {
        try {
            $date = DB::table('business')->where('approval',100)
                ->select('business_id','shop_name','license','image_url','type','message','address','number')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalBusinessSearch($param)
    {
        try {
            $date = DB::table('business')->where('shop_name','like','%'.$param['name'].'%')
                ->select('business_id','shop_name','license','image_url','type','message','address','number','passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalBusinessPass($param)
    {
        if($param['code']==200){
            try {
                $date = DB::table('business')->where('business_id',$param['businessId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>200
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }
        if($param['code']==100){
            try {
                $date = DB::table('business')->where('business_id',$param['businessId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>100,
                        'reason'=>$param['reason']
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }
    }

    public static function cwp_businessManageShow()
    {
        try {
            $date = DB::table('business')
                ->select('business_id','shop_name','type','license','image_url','type','message','address')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }

    }

    public static function cwp_businessManageAlter($param)
    {
        if (($param->hasFile('image_url') && $param->file('image_url')->isValid())) {
            $path_1 = md5(time() . rand(1000, 9999)) .
                '.' . $param->file('image_url')->getClientOriginalExtension();
            $param->file('image_url')->move('./public', $path_1);
            $data['image_url'] = './public' . $path_1;
        }
        try {
            $date = DB::table('business')->where('business_id',$param['businessId'])
                ->update([
                   'shop_name'=>$param['shopName'],
                    'license'=>$param['license'],
                    'image_url'=>$data['image_url'],
                    'message'=>$param['message'],
                    'address'=>$param['address'],
                    'type'=>$param['type']
                ]);
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_businessManageDelete($param)
    {
        try {
            $date = DB::table('business')->where('business_id',$param['businessId'])->delete();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_businessManageDetail($param)
    {
        try {
            $data = DB::table('business')->where('business_id',$param['businessId'])
                ->select('business_id','shop_name','license','image_url','message','address','type','number')->get();

            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_businessManageSearch($param)
    {
        try {
            $date = DB::table('business')->where('shop_name','like','%'.$param['shop_name'].'%')
                ->select('business_id','shop_name','type','license','image_url','message','address')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalGoodsShowed()
    {
        try {
            $data = DB::table('goods')->where('approval',200)
                ->select('goods_id','goods_name','category','price','image_url','passing')->get();

            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }

    }
    public static function cwp_approvalGoodsShowing()
    {
        try {
            $data = DB::table('goods')->where('approval',100)
                ->select('goods_id','goods_name','category','price','image_url')->get();

            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalGoodsSearch($param)
    {
        try {
            $data = DB::table('goods')->where('goods_id',$param['goodsId'])
                ->select('goods_id','goods_name','category','price','image_url','passing')->get();

            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalGoodsPass($param)
    {
        if($param['code']==200){
            try {
                $date = DB::table('goods')->where('goods_id',$param['goodsId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>200
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }
        if($param['code']==100){
            try {
                $date = DB::table('goods')->where('goods_id',$param['goodsId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>100,
                        'reason'=>$param['reason']
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }

    }
    public static function cwp_goodsManageShow()
    {
        try {
            $data = DB::table('goods')->join('business as bn','goods.business_id','bn.business_id')
                ->select('goods.goods_id','goods.goods_name','goods.price','bn.shop_name','goods.image_url')->get();
            return $data;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }
    public static function cwp_goodsManageAlter($param)
    {
        if (($param->hasFile('image_url') && $param->file('image_url')->isValid())) {
            $path_1 = md5(time() . rand(1000, 9999)) .
                '.' . $param->file('image_url')->getClientOriginalExtension();
            $param->file('image_url')->move('./public', $path_1);
            $data['image_url'] = './public' . $path_1;
        }
        try {
            $date = DB::table('goods')->where('goods_id',$param['goodsId'])
                ->update([
                    'goods_name'=>$param['name'],
                    'price'=>$param['price'],
                    'image_url'=> $data['image_url']
                ]);
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }
    public static function cwp_goodsManageDelete($param)
    {
        try {
            $date = DB::table('goods')->where('goods_id',$param['goodsId'])
                ->delete();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }
    public static function cwp_goodsManageSearch($param)
    {
        try {
            $data = DB::table('goods')->join('business as bn','goods.business_id','bn.business_id')
                ->where('goods_name','like','%'.$param['goodsName'].'%')
                ->select('goods.goods_id','goods.goods_name','goods.price','bn.shop_name','goods.image_url')->get();
            return $data;
        } catch (\Exception $e) {
            logError('创建用户失败',[$e->getMessage()]);
            return null;
        }
    }
    public static function cwp_approvalRiderShowed()
    {
        try {
            $data = DB::table('rider')->where('approval',200)
                ->select('rider_id','number','gender','region','age','passing')->get();
            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalRiderShowing()
    {
        try {
            $data = DB::table('rider')->where('approval',100)
                ->select('rider_id','number','gender','region','age')->get();
            return $data;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalRiderSearch($param)
    {
        try {
            $date = DB::table('rider')->where('name','like','%'.$param['name'].'%')
                ->select('rider_id','number','gender','region','age','passing')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_approvalRiderPass($param)
    {
        if($param['code']==200){
            try {
                $date = DB::table('rider')->where('rider_id',$param['riderId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>200
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }
        if($param['code']==100){
            try {
                $date = DB::table('rider')->where('rider_id',$param['riderId'])
                    ->update([
                        'approval'=>200,
                        'passing'=>100,
                        'reason'=>$param['reason']
                    ]);
                return $date;
            } catch (\Exception $e) {
                logError('查询失败', [$e->getMessage()]);
                return null;
            }
        }

    }
    public static function cwp_riderManageShow()
    {
        try {
            $date = DB::table('rider')
                ->select('rider_id','number','gender','region','age')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }
    public static function cwp_riderManageAlter($param)
    {
        try {
            $date = DB::table('rider')->where('rider_id',$param['riderId'])
                ->update([
                    'number'=>$param['number'],
                    'gender'=>$param['gender'],
                    'region'=>$param['region'],
                    'age'=>$param['age']
                ]);
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_riderManageDelete($param)
    {

        try {
            $date = DB::table('rider')->where('rider_id',$param['riderId'])->delete();
            return $date;
        } catch (\Exception $e) {
            logError('删除失败', [$e->getMessage()]);
            return null;
        }
    }

    public static function cwp_riderManageSearch($param)
    {
        try {
            $date = DB::table('rider')->where('name','like','%'.$param['name'].'%')
                ->select('rider_id','number','gender','region','age')->get();
            return $date;
        } catch (\Exception $e) {
            logError('查询失败', [$e->getMessage()]);
            return null;
        }
    }

}
