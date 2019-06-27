@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-4">Pesquisa e filtros</h4>
        </div>
    </div>
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <h4 class="card-title mb-4">Agendamentos</h4>
            @foreach ($schedules as $schedule)
                <div class="d-flex justify-content-between">
                    <p><a href={{ $schedule->link() }}>{{ $schedule->client }} - 
                        {{ $schedule->archived_at ? 'Arquivado' : $schedule->formattedSchedule() }}
                    </a></p>
                    <p class="mr-4"><a href={{ $schedule->link() . "/edit" }}>Editar</a></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
