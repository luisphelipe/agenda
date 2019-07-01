@extends('layouts.app')

@section('custom-links')
    @include('services.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="{{ $service->link() }}" method="POST">
                @method('PUT')
                @csrf

                <label for="client">Titulo*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="title" placeholder="Nome do Serviço" value="{{ $service->title }}">
                </div>

                <label for="service">Preco*</label>
                <div class="input-group">
                    <input class="form-control" type="number" name="price" value="{{ $service->price }}">
                </div>

                <label for="service">Duracao*</label>
                <div class="input-group">
                    <input class="form-control" type="number" name="duration" placeholder="Duração do Serviço" value="{{ $service->duration }}">
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ $service->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Editar Serviço</button>
                <a href="{{ $service->link() }}" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
