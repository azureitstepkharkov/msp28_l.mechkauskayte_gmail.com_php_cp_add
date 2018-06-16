<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    /**
     * Table, connected with model.
     *
     * @var string
     */
    protected $table = 'tasks';
    /**
     * Defines if timestamps updated_at and created_at have to be processed.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'start',
        'end',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'task_user', 'id_task', 'id_user');
    }

    public function project()
    {
        return $this->hasOne('App\Project','id', 'project_id');
    }

    public function attachUser($user)
    {
        if(is_object($user)) {
            $user = $user->getKey();
        }

        if(is_array($user)) {
            $user = $user['id'];
        }
        $this->users()->attach($user);
    }

    public static function showTaskForUsers($id){
        $users = DB::table('tasks')
            ->leftjoin('task_user', 'tasks.id', '=', 'task_user.id_task')
            ->leftjoin('users', 'users.id', '=', 'task_user.id_user')
            ->select('tasks.*')
            ->where('users.id', '=', $id)
            ->get();
        return $users;
    }
}
