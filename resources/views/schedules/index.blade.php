@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-4">Filtros</h4>
        </div>
    </div>
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <h4 class="card-title mb-4">Agendamentos</h4>
            @foreach ($schedules as $schedule)
                <div class="row">
                    <div class="col-md-10">
                        <p><a href={{ $schedule->link() }}>{{ $schedule->client }} - {{ $schedule->formattedSchedule() }}</a></p>
                    </div>
                    <div class="col-md-2">
                        <p><a href={{ $schedule->link() . "/edit" }}>Editar</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
