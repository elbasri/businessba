<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';


    public function type(){
        return $this->hasOne('App\Orbscope\Models\CustomerType','id','type_id');
    }

    public function agent(){
        return $this->hasOne('App\Orbscope\Models\Employee','id','employee_id');
    }

    public function city(){
        return $this->hasOne('App\Orbscope\Models\City','id','city_id');
    }
}
