<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'imageType'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Technology', 'technology_user', 'user_id', 'technology_id');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'task_user', 'id_user', 'id_task');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function ClientProjects()
    {
        return $this->hasMany('App\Project', 'clients_id', 'id');
    }
    public function MemberProjects()
    {
        return $this->belongsToMany('App\Project', 'project_user', 'id_user', 'id_project');
    }

    public static function usersForTasks(){
        $users = DB::table('users')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftjoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.status', 'roles.name as roleName')
            ->where('roles.name', '=', 'Programmer')
            ->orWhere('roles.name', '=', 'TeamLeader')
            ->get();
        return $users;
    }

    public static function showUsers($roleName){
        $users = DB::table('users')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftjoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.status', 'roles.name as roleName')
            ->where('roles.name', '=', $roleName)
            ->get();
        return $users;
    }

    public static function getEmployees()
    {
        $users = DB::table('users')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftjoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'users.status')
            ->where('roles.name', '=', 'Programmer')
            ->orWhere('roles.name', '=', 'ProjectMan')
            ->orWhere('roles.name', '=', 'TeamLeader')
            ->distinct()
            ->get();
        return $users;
    }

}
