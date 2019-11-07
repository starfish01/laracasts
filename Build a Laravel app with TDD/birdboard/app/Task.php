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


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function completed()
    {
        $this->project->recordActivity('completed_task');
        $this->update([
            'completed' => true
        ]);
    }

    public function incomplete()
    {
        $this->project->recordActivity('incomplete_task');
        $this->update([
            'completed' => false
        ]);
    }
}
