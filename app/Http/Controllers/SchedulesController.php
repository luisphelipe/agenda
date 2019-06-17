<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = auth()->user()
            ->schedules()
            ->orderBy('schedule', 'ASC')
            ->get();

        return view('schedules.index', [
            'schedules' => $schedules
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'client' => 'required|string',
            'service' => 'required|string',
            'schedule' => 'required|date',
            'description' => 'required|string',
        ]);

        $schedule = auth()->user()
            ->schedules()
            ->create($data);

        return redirect()->action(
            'ScheduleController@show',
            ['schedule' => $schedule]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 401);

        return view('schedules.show', [
            'schedule' => $schedule
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', [
            'schedule' => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 401);

        // I' m not sure if required is correct here,
        // Since i don't necessarily want to update everything everytime,
        // But i also don't want to update to null.
        $data = $request->validate([
            'service' => 'nullable|string',
            'schedule' => 'nullable|date',
            'description' => 'nullable|string',
            'archived_at' => 'nullable|date'
        ]);

        $schedule->update($data);

        return redirect()->action(
            'ScheduleController@show',
            ['schedule' => $schedule]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 401);

        $schedule->delete();

        return redirect()->action('ScheduleController@index');
    }
}
