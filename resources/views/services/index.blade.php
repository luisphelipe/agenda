@extends('layouts.app')

@section('custom-links')
    @include('services.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-3">Pesquisa</h4>
            <form class="form-inline" action="/services" method="GET">
                @csrf

                <input class="form-control mr-2 mt-1" type="text" name="search" placeholder="Nome do Serviço" value="{{ app('request')->input('search') }}" />

                <div class="mt-1">
                    <button class="btn btn-primary mr-2" type="submit">Pesquisar</button>
                    <a href="/services" class="mt-2">Limpar</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <div class="d-flex justify-content-between align-content-center">
                <h4 class="card-title mb-4">Serviços</h4>
                <div class="mr-4">
                    <a href="/services/create">Criar</a>
                </div>
            </div>

            @foreach ($services as $service)
                <div class="d-flex justify-content-between">
                    <p><a href={{ $service->link() }}>{{ $service->title }}</a> - {{ 'R$' . $service->price }}</p>
                    <p class="mr-4"><a href={{ $service->link() . "/edit" }}>Editar</a></p>
                </div>
            @endforeach
        </div>
                

        <div id="pagination" class="d-flex justify-content-around">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
