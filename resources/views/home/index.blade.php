@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div id="root"></div> --}}
            @foreach ($schedules as $schedule)
                <p>This schedule client is {{ $schedule->client }}</p>
            @endforeach

        </div>
    </div>
</div>
@endsection
