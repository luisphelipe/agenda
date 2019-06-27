<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
            ->whereNull('archived_at')
            ->orderBy('schedule', 'ASC')
            ->get();

        $archivedSchedules = auth()->user()
            ->schedules()
            ->whereNotNull('archived_at')
            ->orderBy('schedule', 'DESC')
            ->get();

        return view('schedules.index', [
            'schedules' => $schedules->concat($archivedSchedules)
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
            'description' => 'nullable|string',
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

        $data = $request->validate([
            'client' => 'nullable|string',
            'service' => 'nullable|string',
            'schedule' => 'nullable|date',
            'description' => 'nullable|string',
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

    public function archive(Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 401);

        $schedule->update([
            'archived_at' => (String)Carbon::now()
        ]);

        return redirect()->action(
            'ScheduleController@show',
            ['schedule' => $schedule]
        );
    }
}
