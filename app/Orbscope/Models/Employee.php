<?php

namespace App\Orbscope\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    protected $table='employees';


    public function branch(){
        return $this->hasOne('App\Orbscope\Models\Branch','id','branch_id');
    }

    public function city(){
        return $this->hasOne('App\Orbscope\Models\City','id','city_id');
    }

    public function depart(){
        return $this->hasOne('App\Orbscope\Models\Department','id','depart_id');
    }

    public function position(){
        return $this->hasOne('App\Orbscope\Models\Position','id','postion_id');
    }

    public function vacations(){
        return $this->hasMany('App\Orbscope\Models\Vacation','employee_id','id');
    }

    public function stay(){
        return $this->hasMany('App\Orbscope\Models\Stay','employee_id','id');
    }



    public function branchHistoric(){
        return $this->hasMany('App\Orbscope\Models\BranchHistoric','employee_id','id')->OrderBy('date','desc');
    }

    public function departHistoric(){
        return $this->hasMany('App\Orbscope\Models\Depart_Historic','employee_id','id')->OrderBy('date','desc');

    }

    public function postionHistoric(){
        return $this->hasMany('App\Orbscope\Models\PostionHistoric','employee_id','id')->OrderBy('date','desc');
    }

    public function salary(){
        return $this->hasMany('App\Orbscope\Models\Salary','employee_id','id')->orderBy('date','desc');
    }

    public function sub($year,$month){
        return $this->hasMany('App\Orbscope\Models\Subtract','employee_id','id')->where('type','sub')->whereYear('date', $year)->whereMonth('date', $month);
    }

    public function reword($year,$month){
        return $this->hasMany('App\Orbscope\Models\Subtract','employee_id','id')->where('type','reword')
            ->whereYear('date', $year)
            ->whereMonth('date', $month);
    }

    public function employesub($year,$month){
        return $this->hasMany('App\Orbscope\Models\Subtract','employee_id','id')->whereYear('date', $year)->whereMonth('date', $month);

    }
}
