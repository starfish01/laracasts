<?php

namespace App;

use App\Activity;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];


    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created','deleted'];


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
        $this->recordActivity('completed_task');
        $this->update([
            'completed' => true
        ]);
    }

    public function incomplete()
    {
        $this->recordActivity('incomplete_task');
        $this->update([
            'completed' => false
        ]);
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

}
