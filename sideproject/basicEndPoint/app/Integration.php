<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $fillable = [
        'title',
        'owner_id'
    ];

    public function data()
    {
        return $this->hasMany(Integration_data::class);
    }

    public function addData($data)
    {
        $this->data()->create($data);
    }
}
