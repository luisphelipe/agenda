<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const TYPES = [
        'DINHEIRO',
        'DEBITO',
        'CREDITO'
    ];

    protected $fillable = [
        'value', 'type', 'schedule_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {
        return '/payments/' . $this->id;
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function getTypeAttribute($type)
    {
        return self::TYPES[$type];
    }
}
