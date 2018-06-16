<?php

namespace App;
use Zizaco\Entrust\EntrustRole;

use Illuminate\Database\Eloquent\Model;

class Role extends EntrustRole
{
    use \Traits\EntrustRole;
    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
    public function users()
    {
        return $this->belongsToMany('app\User', 'role_user', 'role_id', 'user_id');
    }
}
