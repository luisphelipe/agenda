<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = auth()->user()
            ->services()
            ->where('title', 'LIKE', "%{$request->input('search')}%")
            ->orderBy('updated_at', 'DESC')
            ->paginate(15);

        return view('services.index', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
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
            'title' => 'required|string',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $service = auth()->user()
            ->services()
            ->create($data);

        return redirect()->action(
            'ServiceController@show',
            ['service' => $service]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        abort_unless(auth()->user()->owns($service), 401);

        return view('services.show', [
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        abort_unless(auth()->user()->owns($service), 401);

        return view('services.edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        abort_unless(auth()->user()->owns($service), 401);

        $data = $request->validate([
            'title' => 'nullable|string',
            'duration' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $service->update($data);

        return redirect()->action(
            'ServiceController@show',
            ['service' => $service]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        abort_unless(auth()->user()->owns($service), 401);

        $service->delete();

        return redirect()->action('ServiceController@index');
    }
}
