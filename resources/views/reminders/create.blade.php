@extends('layouts.app')

@section('custom-links')
    @include('reminders.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="/reminders" method="POST">
                @csrf

                <label for="client">Texto*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="text" placeholder="Texto para lembrar" value={{ old('text') }}>
                </div>

                <label for="schedule">Data</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="date" value={{ old('date') }}>
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

               <button type="submit" class="btn btn-primary">Criar Lembrete</button>
                <a href="/reminders" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
