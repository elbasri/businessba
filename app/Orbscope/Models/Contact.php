<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    
    public function job () {
        return $this->belongsTo('App\Orbscope\Models\Job', 'job_id');
    }

    public function branch(){
        return $this->hasOne('App\Orbscope\Models\Branch','id','branch_id');
    }
}
