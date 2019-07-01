<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'date', 'text', 'closed_at'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {
        return '/reminders/' . $this->id;
    }

    public function getDateAttribute($date)
    {
        if (!$date) return null;
        return date_format(date_create($date), 'd/m/Y H:i');
    }

    public function getClosedAtAttribute($closed_at)
    {
        if (!$closed_at) return null;
        return date_format(date_create($closed_at), 'd/m/Y H:i');
    }

    public function formFriendlyDate()
    {
        return str_replace(" ", "T", $this->getOriginal('date'));
    }
}
