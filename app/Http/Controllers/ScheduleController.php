<?php

namespace App\Http\Controllers;

use App\Schedule;
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
        $schedules = auth()->user()->schedules;

        return response($schedules, 200);
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
            'description' => 'required|string'
        ]);

        $schedule = auth()->user()->schedules()->create([
            'client' => $data['client'],
            'service' => $data['service'],
            'decription' => $data['description']
        ]);

        return response($schedule, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 403);

        return response($schedule, 200);
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
        abort_unless(auth()->user()->owns($schedule), 403);

        // I'm not sure if required is correct here, 
        // Since i don't necessarily want to update everything everytime,
        // But i also don't want to update to null.
        $data = $request->validate([
            'client' => 'required|string',
            'service' => 'required|string',
            'description' => 'required|string'
        ]);

        $schedule->update($data);

        return response($schedule, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        abort_unless(auth()->user()->owns($schedule), 403);

        $schedule->delete();

        return response(null, 204);
    }
}
