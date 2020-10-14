<?php

namespace App\Orbscope\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='invoices';


    public function customer(){
        return $this->hasOne('App\Orbscope\Models\Customer','id','customer_id');
    }

    public function type(){
        return $this->hasOne('App\Orbscope\Models\InvoiceType','id','invoice_type');
    }

    public function currency(){
        return $this->hasOne('App\Orbscope\Models\Currency','id','currency_id');
    }

    public function payments(){
        return $this->hasMany('App\Orbscope\Models\Payment','invoice_id','id');
    }

    public function logs(){
        return $this->hasMany('App\Orbscope\Models\Invoice_Log','invoice_id','id');
    }
}
