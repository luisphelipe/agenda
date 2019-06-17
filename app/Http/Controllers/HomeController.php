<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Schedule;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $daily_schedules = $user
            ->todaySchedules;

        // $open_reminders = $user
        //     ->openReminders;

        return view('home.index', [
            'schedules' => $daily_schedules,
            // 'reminders' => $open_reminders,
        ]);
    }
}
