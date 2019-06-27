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

    public function formattedDate()
    {
        return date_format(date_create($this->date), 'd/m/Y H:i:s');
    }
}
