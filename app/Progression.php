<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    protected $table = 'progressions';
    protected $fillable = [
        'project_id','pourcentage_id',
    ] ;

    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }
}
