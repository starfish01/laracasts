<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'changes' => 'array'
    ];

    public $old = [];

    public function subject()
    {
        return $this->morphTo();
    }
}
