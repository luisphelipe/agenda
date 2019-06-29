<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'duration', 'price', 'description'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {
        return '/services/' . $this->id;
    }
}
