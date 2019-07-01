<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = auth()->user()
            ->payments()
            ->orderBy('updated_at', 'DESC')
            ->paginate(15);

        return view('payments.index', [
            'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // flawed, still passes if chosen schedule is not his
        $data = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'value' => 'required|numeric',
            // needs testing, 0, 1 and 2 should be valid types
            'type' => 'required|numeric|between:0,2'
        ]);

        $payment = auth()->user()
            ->payments()
            ->create($data);

        return redirect()->action(
            'ScheduleController@show',
            ['schedule' => $payment->schedule]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        abort_unless(auth()->user()->owns($payment), 401);

        return view('payments.show', [
            'payment' => $payment,
            'payment_types' => Payment::TYPES
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        abort_unless(auth()->user()->owns($payment), 401);

        return view('payments.edit', [
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        abort_unless(auth()->user()->owns($payment), 401);

        // flawed, still passes if chosen schedule is not his
        $data = $request->validate([
            'value' => 'nullable|numeric',
            'type' => 'nullable|numeric|between:0,2'
        ]);

        $payment->update($data);

        return redirect()->action(
            'PaymentController@show',
            ['payment' => $payment]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        abort_unless(auth()->user()->owns($payment), 401);

        $payment->delete();

        return redirect()->action('PaymentController@index');
    }
}
