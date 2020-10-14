<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table='salaries';


    public function agent(){
        return $this->hasOne('App\Orbscope\Models\Employee','id','employee_id');
    }
}
