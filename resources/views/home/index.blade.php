@extends('layouts.app')

@section('content')
<div class="container pt-0">
    <div class="row pl-3 pt-0 h-100">
        <div id="home-left-panel" class="col-sm-6 card pl-2 pt-1">
            <div class="card-body">
                <h4 class="card-title mb-4">Agenda do dia</h4>
                @foreach ($schedules as $schedule)
                    <p class="card-text"><a href="{{ $schedule->link() }}">{{ $schedule->client }} - {{ $schedule->formattedSchedule() }}</a></p>
                @endforeach
            </div>
        </div>
        <div id="home-right-panel" class="col-sm-6">
            <div id="home-right-panel-top" class="card mb-2 pl-2 pt-1">
                <div class="card-body">
                    <h4 class="card-title">Acoes</h4>
                    <a href="{{ route('schedules.create') }}">{{ __('Criar agendamento') }}</a> 
                </div>
            </div>
            <div id="home-right-panel-bot" class="card pl-2 pt-1">
                <div class="card-body">
                    <h4 class="card-title">Lembretes</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
