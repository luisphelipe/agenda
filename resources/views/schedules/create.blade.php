@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="/schedules" method="POST">
                @csrf

                <label for="client">Cliente*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="client" placeholder="Selecione a cliente" value={{ old('client') }}>
                </div>

                <label for="service">Servico*</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="service" placeholder="Selecione o servico" value={{ old('service') }}>
                </div>

                <label for="schedule">Data*</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="schedule" value={{ old('schedule') }}>
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Agendar Cliente</button>
                <a href="/schedules" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection