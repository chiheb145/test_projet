<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    protected $table = 'projects';
    protected $fillable = [ 
    	'name','client_id','description','offreS','offreP','estimationS','estimationP',
    ] ;

    public function tasks() {
    	return $this->hasMany('App\Task');
    }

    public function client()
    {
        return $this->belongsTo('App\User','client_id');
    }

    public function progression(){
        $Ctask=Task::where('project_id',$this->id)->get();

        if(count($Ctask) == 0){
            $progress=0;
        }
        elseif(count($Ctask) > 0){
            $task=Task::where('project_id',$this->id)->where('status_id',2)->get();
            $taskclosed=count($task);
            $progress=($taskclosed/count($Ctask))*100;
        }
        return $progress ;
    }

    public function status(){
        $tasks=Task::where('project_id',$this->id)->get();
        $status = 'Nouveau';
        $a=count($tasks);
        foreach ($tasks as $task){
            if($task->status_id != 2){
                $status='En cours';
            }
        }
        if ($a >0 && $status == 'Nouveau'){
            $status='Terminer';
        }
        return $status;
    }
}
