<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    // Relation with users table
    public function user_log(){
        return $this->hasOne('App\User','id','user_id');
    }

}
