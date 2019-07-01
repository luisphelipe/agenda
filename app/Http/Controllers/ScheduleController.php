<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Payment;
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
            ->orderBy('archived_at', 'DESC')
            ->orderBy('schedule', 'ASC')
            ->paginate(10);

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
        return view('schedules.create', [
            'services' => auth()->user()->services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // security flaw known at implementations time:
        // this validation doesnt prevent using another user service 
        $services = $request->validate([
            'services.0' => 'required|exists:services,id',
            'services.*' => 'required|exists:services,id'
        ])['services'];

        $data = $request->validate([
            'client' => 'required|string',
            'schedule' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $schedule = auth()->user()
            ->schedules()
            ->create($data);

        $schedule->services()->attach($services);

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
            'schedule' => $schedule,
            'payment_types' => Payment::TYPES
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
        abort_unless(auth()->user()->owns($schedule), 401);

        return view('schedules.edit', [
            'schedule' => $schedule,
            'services' => auth()->user()->services
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

        $services = $request->validate([
            'services.*' => 'required|exists:services,id'
        ])['services'];

        $data = $request->validate([
            'client' => 'nullable|string',
            'schedule' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $schedule->update($data);

        $schedule->services()->sync($services);

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
            'archived_at' => (string) Carbon::now()
        ]);

        return redirect()->action(
            'ScheduleController@show',
            ['schedule' => $schedule]
        );
    }
}
