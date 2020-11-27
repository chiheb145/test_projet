<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    //
    protected $table = 'uploadfiles';
    protected $fillable = [
        'url', 'intervention_id','project_id','task_id','subtask_id'
    ];

    public function intervention()
    {
        return $this->belongsTo('App\Intervention','intervention_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    public function task()
    {
        return $this->belongsTo('App\Task','task_id');
    }

    public function subtask()
    {
        return $this->belongsTo('App\Subtask','subtask_id');
    }
}
