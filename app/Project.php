<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\models\Task;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'clients_id', // тут поменять на user_id у нескольких юзеров один и тот же проект проект, и уюзера несколько проектов
        'status'
    ];

    public function members()
    {
        return $this->belongsToMany('App\User', 'project_user', 'id_project', 'id_user');
    }
    public function tasks()
    {
        return $this->hasMany('App\Task','project_id','id');
    }
    public  function client()
    {
        return $this->hasOne('App\User', 'id','clients_id');
    }
}
