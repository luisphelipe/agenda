@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="{{ $schedule->link() }}" method="POST">
                @method('PUT')
                @csrf

                <label for="client">Cliente*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="client" id="client" placeholder="Selecione a cliente" value="{{ $schedule->client }}">
                </div>

                <label for="service">Servico*</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="service" id="service" placeholder="Selecione o servico" value="{{ $schedule->service }}">
                </div>

                <label for="schedule">Data*</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" id="schedule" name="schedule" value="{{ str_replace(" ", "T", $schedule->schedule) }}">
                </div>

                <label for="description">Descrição</label>
                <div class="form-group">
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $schedule->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Editar Agendamento</button>
                <a href="/schedules" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
