<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'tasks';
    protected $fillable = [
        'project_id', 'user_id', 'title', 'description', 'priority_id', 'status_id','date_start','date_end','somme','offreS','offreP','estimationS','estimationP','prix','cout_realP'
    ];


    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function priorities()
    {
        return $this->belongsTo('App\TachePrioritie', 'priority_id');
    }

    public function status()
    {
        return $this->belongsTo('App\TacheStatu','status_id');
    }

    public function soustaches()
    {
        $subtasks=Subtask::where('task_id',$this->id)->get();
        return $subtasks;
    }

    public function cout_real(){
        $begin=$this->somme;
        if ($begin == null){
            $cout =0;
        }
        else{
            $prix=($this->prix)/3600;
            $cout=$begin * $prix;
        }

        return $cout;
    }

    public function somme()
    {
        $end=$this->somme;

        if($end == null){
            $somme=0;
        }
        else{

            $somme=gmdate("H:i:s", $end);
        }
        return $somme;
    }

    public function isallsubtaskclosed()
    {
        $isclosed=true;
        $subtasks=$this->soustaches();

            foreach ($subtasks as $subtask){
                if($subtask->status_id != 2){
                    $isclosed=false;
                }
            }
       return $isclosed;
    }


}
