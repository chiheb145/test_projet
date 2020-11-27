<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    //

    protected $fillable = [
        'title', 'content', 'created_by','status_id','priority_id','closed_at','reopen'
    ];


    public function creation()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function status()
    {
        return $this->belongsTo('App\TacheStatu','status_id');
    }

    public function priorities()
    {
        return $this->belongsTo('App\TachePrioritie','priority_id');
    }
}
