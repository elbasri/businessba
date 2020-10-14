<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Authorizable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // Relation With Log Table
    public function log(){
        return $this->hasMany('App\Orbscope\Models\Log','user_id','id');
    }

    public function agent_types(){
        return $this->hasOne('App\Orbscope\Models\AgentType','id','agent_type');
    }

    public function calls() {
        return $this->hasMany('App\Orbscope\Models\Call', 'agent_id');
    }

    public function meetings() {
        return $this->hasMany('App\Orbscope\Models\Meeting', 'agent_id');
    }

    public function complains()
    {
        return $this->hasMany('App\Orbscope\Models\Complain', 'agent_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Orbscope\Models\Order', 'agent_id');
    }

    public function cils()
    {
        return $this->hasMany('App\Orbscope\Models\CIL', 'agent_id');
    }

    public function leads()
    {
        return $this->hasMany('App\Orbscope\Models\Lead', 'agent_id');
    }

}
