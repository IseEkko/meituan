<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Businessrider extends Model
{
    protected $table = "business_rider";
    public $timestamps = true;
    protected $primaryKey = "business_rider_id";
    protected $guarded = [];

    /**
     *展示当前骑手与所有用户，商家消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showRiderUserInformationAll($request)
    {
        try{
            $date=Businessrider::where('rider_id',$request['rider_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与所有商家消息',[$e->getMessage()]);
        }
    }
    /**
     *展示当前商家与所有用户，骑手消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showBusinessUserInformationAll($request)
    {
        try{
            $date=Businessrider::where('business_id',$request['business_id'])
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前商家与所有骑手消息',[$e->getMessage()]);
        }
    }
    /**
     *展示当前骑手与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_showRiderBusinessInformation($request)
    {
        try{
            $date=Businessrider::where('rider_id',$request['rider_id'] )
                ->where('business_id',$request['business_id'] )
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与商家对话消息',[$e->getMessage()]);
        }
    }

    /**
     *发送当前骑手与商家对话消息
     * @author tangbangyan <github.com/doublebean>
     * @param  $request
     * @return mixed
     */
    public static function tby_talkRiderBusinessInformation($request)
    {
        try{
            if($request['type'] == 1)
            {
                $date=Businessrider::create([
                        'rider_id'=>$request['rider_id'],
                        'business_id'=>$request['business_id'],
                        'rider_message'=>$request['message'],
                    ]
                );
            }
            elseif ($request['type'] == 2)
            {
                $date=Businessrider::create([
                    'rider_id'=>$request['rider_id'],
                    'business_id'=>$request['business_id'],
                    'business_message'=>$request['message'],
                ]);
            }

            return true;
        }catch(Exception $e){
            logger::Error('没有找到当前骑手与商家对话消息',[$e->getMessage()]);
        }
    }
}
