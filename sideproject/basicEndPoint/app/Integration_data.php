<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integration_data extends Model
{
    protected $fillable = [
        'title',
        'description',
        'owner_id',
        'integration_id'
    ];

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }
}
