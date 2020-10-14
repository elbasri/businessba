<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_Log extends Model
{
    protected $table='invoice__logs';


    public function agent(){
        return $this->hasOne('App\User','id','employee_id');
    }
}
