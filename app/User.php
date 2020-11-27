<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tacheAgent()
    {
        return $this->hasMany('App\Tache','agent_id');
    }

    public function tacheClient()
    {
        return $this->hasMany('App\Tache','created_by');
    }


    public function interventionAgent()
    {
        return $this->hasMany('App\Intervention','agent_id');
    }
    public function active()
    {
        return $this->hasMany('App\User',$this->status=0);
    }

    public function task()
    {
        return $this->hasMany('App\Task','user_id');
    }

    public function subtask()
    {
        return $this->hasMany('App\Subtask','user_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function hasPermission($name)
    {
        if ($this->role->permissions->where('key', $name)->first()) {
            return true;
        }
        return false;
    }

    public function listtask()
    {
        $list=Task::where('user_id',$this->id)->where('status_id','!=',2)->get();
        return $list;
    }

    public function listsubtask()
    {
        $list=Subtask::where('user_id',$this->id)->where('status_id','!=',2)->get();
        return $list;
    }

    public function listintervention()
    {
        $list=Intervention::where('agent_id',$this->id)->where('status_id','!=',2)->get();
        return $list;
    }

}
