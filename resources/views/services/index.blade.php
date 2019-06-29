@extends('layouts.app')

@section('custom-links')
    @include('services.__links')
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
            <h4 class="card-title mb-4">Servicos</h4>
            @foreach ($services as $service)
                <div class="d-flex justify-content-between">
                    <p><a href={{ $service->link() }}>{{ $service->title}} - {{ 'R$' . $service->price }}</a></p>
                    <p class="mr-4"><a href={{ $service->link() . "/edit" }}>Editar</a></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
