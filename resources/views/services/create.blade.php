@extends('layouts.app')

@section('custom-links')
    @include('services.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="/services" method="POST">
                @csrf

                <label for="client">Titulo*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="title" placeholder="Nome do Serviço" value={{ old('service') }}>
                </div>

                <label for="schedule">Preço*</label>
                <div class="input-group">
                    <input class="form-control" type="number" name="price" placeholder="Preco do Serviço" value={{ old('price') }}>
                </div>

                <label for="duration">Duração*</label>
                <div class="input-group">
                    <input class="form-control" type="number" name="duration" placeholder="Duração do Serviço" value={{ old('duration') }}>
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Registar Serviço</button>
                <a href="/services" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
