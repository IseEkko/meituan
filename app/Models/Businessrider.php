<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Businessrider extends Model
{
    protected $table = "business_rider";
    public $timestamps = true;
    protected $primaryKey = "business_rider_id";
    protected $guarded = [];
}
