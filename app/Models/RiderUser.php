<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderUser extends Model
{
    protected $table = "rider_user";
    public $timestamps = true;
    protected $primaryKey = "rider_user_id";
    protected $guarded = [];
}
