<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_categories';

    public function category(){
        return $this->belongsTo('App\Orbscope\Models\Category','cat_id');
    }

    public function freelancers()
    {
        return $this->belongsToMany('App\Orbscope\Models\FreeLancer','lancer_subs','sub_id','lancer_id');
    }
}
