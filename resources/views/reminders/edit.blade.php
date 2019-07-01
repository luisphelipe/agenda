@extends('layouts.app')

@section('custom-links')
    @include('reminders.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="{{ $reminder->link() }}" method="POST">
                @method("PUT")
                @csrf

                <label for="client">Texto*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="text" placeholder="Texto para lembrar" value="{{ $reminder->text }}">
                </div>

               <label for="schedule">Data</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="date" value="{{ $reminder->formFriendlyDate() }}">
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ $reminder->description }}</textarea>
                </div>

               <button type="submit" class="btn btn-primary">Editar Lembrete</button>
                <a href="{{ $reminder->link() }}" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
