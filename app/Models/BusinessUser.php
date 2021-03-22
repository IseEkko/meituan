<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class BusinessUser extends Model
{
    protected $table = "business_user";
    public $timestamps = true;
    protected $primaryKey = "business_user_id";
    protected $guarded = [];

    /**
     *展示当前商家与所有用户，骑手消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showBusinessUserInformationAll($request)
    {
        try{
            $date=BusinessUser::where('business_id',$request['business_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前商家与所有用户消息',[$e->getMessage()]);
        }
    }
    /**
     *展示当前用户与所有商家，骑手消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showUserBusinessInformationAll($request)
    {
        try{
            $date=BusinessUser::where('user_id',$request['user_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前用户与所有商家消息',[$e->getMessage()]);
        }
    }

    /**
     *展示当前用户与所有商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showUserBusinessInformation($request)
    {
        try{
            $date=BusinessUser::where('user_id',$request['user_id'] )
                ->where('business_id',$request['business_id'] )
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与商家对话消息',[$e->getMessage()]);
        }
    }

    /**
     *发送当前用户与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_talkUserBusinessInformation($request)
    {
        try{
            if($request['type'] == 1)
            {
                $date=BusinessUser::create([
                        'user_id'=>$request['user_id'],
                        'business_id'=>$request['business_id'],
                        'user_message'=>$request['message'],
                    ]
                );
            }
            elseif ($request['type'] == 2)
            {
                $date=BusinessUser::create([
                    'user_id'=>$request['user_id'],
                    'business_id'=>$request['business_id'],
                    'business_message'=>$request['message'],
                ]);
            }

            return true;
        }catch(Exception $e){
            logger::Error('没有找到当前用户与商家对话消息',[$e->getMessage()]);
        }
    }
}
