<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';

    public function shop(){
        return $this->belongsTo('App\Orbscope\Models\Shop','shop_id');
    }
    public function shops(){
        return $this->hasOne('App\Orbscope\Models\Shop','id','shop_id');
    }

    public function subCats()
    {
        return $this->hasMany('App\Orbscope\Models\SubCategory', 'cat_id');
    }

    public function freelancers()
    {
        return $this->hasMany('App\Orbscope\Models\FreeLancer', 'cat_id');
    }

}
