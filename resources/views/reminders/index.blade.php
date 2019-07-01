@extends('layouts.app')

@section('custom-links')
    @include('reminders.__links')
@endsection

@section('content')
<div class="container">
    {{-- <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-4">Pesquisa e filtros</h4>
        </div>
    </div> --}}
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <h4 class="card-title mb-4">Lembretes</h4>
                @foreach ($reminders as $reminder)
                    <div class="d-flex justify-content-between">
                        <p><a href={{ $reminder->link() }}>{{ $reminder->text }} 
                            {{ $reminder->closed_at ? '- Fechado' : ($reminder->date ? '- ' . $reminder->date : '') }}
                        </a></p>
                        <p class="mr-4"><a href={{ $reminder->link() . "/edit" }}>Editar</a></p>
                </div>
            @endforeach
        </div>

        <div id="pagination" class="d-flex justify-content-around">
            {{ $reminders->links() }}
        </div>
    </div>
</div>
@endsection
