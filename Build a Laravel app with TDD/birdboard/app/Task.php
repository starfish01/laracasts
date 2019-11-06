<?php

namespace App;

use App\Activity;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];


    public static function boot()
    {
        parent::boot();
        static::created(function ($task) {
            $task->project->recordActivity('created_task');
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function complete()
    {
        $this->project->recordActivity('completed_task');
        $this->update([
            'completed' => true
        ]);
    }
}
