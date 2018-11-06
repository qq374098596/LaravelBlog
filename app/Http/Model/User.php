<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'admin';
    //主键
    protected $primaryKey = 'admin_id';
    //更新时间/添加时间
    public $timestamps = false;
}
