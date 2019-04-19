<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'client', 'service', 'schedule', 'description'
    ];

    public function owner() {
        return $this->belongsTo(User::class);
    }
}
