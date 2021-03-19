<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = "goods";
    public $timestamps = true;
    protected $primaryKey = "goods_id";
    protected $guarded = [];
}
