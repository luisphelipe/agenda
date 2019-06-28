<?php

namespace App\Http\Controllers;

use App\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nullDateReminders = auth()->user()
            ->reminders()
            ->whereNull('closed_at')
            ->whereNull('date')
            ->get();

        $reminders = auth()->user()
            ->reminders()
            ->whereNull('closed_at')
            ->whereNotNull('date')
            ->orderBy('date', 'ASC')
            ->get();

        $closedReminders = auth()->user()
            ->reminders()
            ->whereNotNull('closed_at')
            ->orderBy('date', 'DESC')
            ->get();

        $fullReminderList = $nullDateReminders
            ->concat($reminders)
            ->concat($closedReminders);

        return view('reminders.index', [
            'reminders' => $fullReminderList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminders.create');
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
            'text' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $reminder = auth()->user()
            ->reminders()
            ->create($data);

        return redirect()->action(
            'ReminderController@show',
            ['reminder' => $reminder]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        abort_unless(auth()->user()->owns($reminder), 401);

        return view('reminders.show', [
            'reminder' => $reminder
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function edit(Reminder $reminder)
    {
        return view('reminders.edit', [
            'reminder' => $reminder
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reminder $reminder)
    {
        abort_unless(auth()->user()->owns($reminder), 401);

        $data = $request->validate([
            'text' => 'nullable|string',
            'date' => 'nullable|date',
            'closed_at' => 'nullable|date'
        ]);

        $reminder->update($data);

        return redirect()->action(
            'ReminderController@show',
            ['reminder' => $reminder]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reminder $reminder)
    {
        abort_unless(auth()->user()->owns($reminder), 401);

        $reminder->delete();

        return redirect()->action('ReminderController@index');
    }

    public function close(Reminder $reminder)
    {
        abort_unless(auth()->user()->owns($reminder), 401);

        $reminder->update([
            'closed_at' => (String)Carbon::now()
        ]);

        return redirect()->action(
            'ReminderController@show',
            ['reminder' => $reminder]
        );
    }
}