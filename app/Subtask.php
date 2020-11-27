<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    protected $table = 'subtasks';
    protected $fillable = [
        'task_id', 'user_id', 'title', 'description', 'priority_id', 'status_id','date_start','date_end','somme','offreS','offreP','estimationS','estimationP','prix','cout_realP'
    ];
    public function task()
    {
        return $this->belongsTo('App\Task','task_id');
    }

    public function priorities()
    {
        return $this->belongsTo('App\TachePrioritie', 'priority_id');
    }

    public function status()
    {
        return $this->belongsTo('App\TacheStatu','status_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Intervention_comment','subtask_id');
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
}
