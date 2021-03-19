<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUser extends Model
{
    protected $table = "business_user";
    public $timestamps = true;
    protected $primaryKey = "business_user_id";
    protected $guarded = [];
}
