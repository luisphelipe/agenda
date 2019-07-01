@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-3">Pesquisa</h4>
            <form class="form-inline" action="/schedules" method="GET">
                @csrf

                <input class="form-control mr-2 mt-1" type="text" name="search" placeholder="Nome da Cliente" value="{{ app('request')->input('search') }}" />

                <div class="mt-1">
                    <button class="btn btn-primary mr-2" type="submit">Pesquisar</button>
                    <a href="/schedules" class="mt-2">Limpar</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <div class="d-flex justify-content-between align-content-center">
                <h4 class="card-title mb-4">Agendamentos</h4>
                <div class="mr-4">
                    <a href="/schedules/create">Criar</a>
                </div>
            </div>
            @foreach ($schedules as $schedule)
                <div class="d-flex justify-content-between">
                    <p><a href={{ $schedule->link() }}>{{ $schedule->client }}</a> - 
                        {{ $schedule->archived_at ? 'Arquivado' : $schedule->schedule }}
                    </p>
                    <p class="mr-4"><a href={{ $schedule->link() . "/edit" }}>Editar</a></p>
                </div>
            @endforeach
        </div>
        
        <div id="pagination" class="d-flex justify-content-around">
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection
