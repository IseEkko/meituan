<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class RiderUser extends Model
{
    protected $table = "rider_user";
    public $timestamps = true;
    protected $primaryKey = "rider_user_id";
    protected $guarded = [];

    /**
     *展示当前骑手与所有用户消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showRiderUserInformationAll($request)
    {
        try{
            $date=RiderUser::where('rider_id',$request['rider_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与所有用户消息',[$e->getMessage()]);
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
            $date=RiderUser::where('user_id',$request['user_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前用户与所有骑手消息',[$e->getMessage()]);
        }
    }
    /**
     *展示当前骑手与用户对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showRiderUserInformation($request)
    {
        try{
            $date=RiderUser::where('user_id',$request['user_id'] )
                ->where('rider_id',$request['rider_id'] )
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与用户对话消息',[$e->getMessage()]);
        }
    }

    /**
     *发送当前骑手与用户对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_talkRiderUserInformation($request)
    {
        try{
            if($request['type'] == 1)
            {
                $date=RiderUser::create([
                        'rider_id'=>$request['rider_id'],
                        'user_id'=>$request['user_id'],
                        'rider_message'=>$request['message'],
                    ]
                );
            }
            elseif ($request['type'] == 2)
            {
                $date=RiderUser::create([
                        'rider_id'=>$request['rider_id'],
                        'user_id'=>$request['user_id'],
                        'user_message'=>$request['message'],
                ]);
            }

            return true;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与用户对话消息',[$e->getMessage()]);
        }
    }
}
