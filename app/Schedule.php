<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'client', 'service', 'schedule', 'description'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {
        return '/schedules/' . $this->id;
    }

    public function formattedSchedule()
    {
        return date_format(date_create($this->schedule), 'd/m/Y H:i:s');
    }
}
