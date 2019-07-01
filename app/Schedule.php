<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'client', 'service', 'schedule', 'description', 'archived_at'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function link()
    {
        return '/schedules/' . $this->id;
    }

    public function getScheduleAttribute($schedule)
    {
        if (!$schedule) return null;
        return date_format(date_create($schedule), 'd/m/Y H:i');
    }

    public function getArchivedAtAttribute($archived_at)
    {
        if (!$archived_at) return null;
        return date_format(date_create($archived_at), 'd/m/Y H:i');
    }

    public function formFriendlySchedule()
    {
        return str_replace(" ", "T", $this->getOriginal('schedule'));
    }
}
