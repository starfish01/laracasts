<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

    /* if you want to do the oppsite you can use
        protected $guarded =[];

    */


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }
}
