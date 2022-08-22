<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    //
    protected $dates = ['created_at'];
    protected $table = 'login_logs';

    public $timestamps = false;

    protected $fillable = ['user_name', 'user_id','ip','login_status','sys_name','url','created_at'];

}
