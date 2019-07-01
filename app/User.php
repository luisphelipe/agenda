<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function todayReminders()
    {
        return $this->reminders()
            ->whereDate('date', '=', Carbon::now())
            ->orWhereNull('date')
            ->whereNull('closed_at');
    }

    public function todaySchedules()
    {
        return $this->schedules()
            ->whereNull('archived_at')
            ->whereDate('schedule', '=', Carbon::now());
    }

    public function owns(object $item)
    {
        return $this->id == $item->user_id;
    }
}
