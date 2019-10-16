<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    /* if you want to do the oppsite you can use
        protected $guarded =[];

    */
}
