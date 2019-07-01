@extends('layouts.app')

@section('custom-links')
    @include('reminders.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $reminder->text }}</p>
            <p class="card-text">{{ $reminder->date ? $reminder->date : 'Data nao especificada' }}</p>
            @if ($reminder->closed_at)
                <p class="card-text">Fechado em: {{ $reminder->closed_at }}</p>
            @endif
            <p class="card-text mr-4">{{ $reminder->description }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href={{ $reminder->link() . "/edit" }}>Editar</a>
                        @unless ($reminder->closed_at)
                            <a class="ml-4" href={{ $reminder->link() . "/close" }}>Fechar</a>
                        @endunless
                    </div>
                    <a href="/" onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
                </div>
            </p>
            <form id="deleteForm" action="{{ $reminder->link() }}" method="POST">
                @method('DELETE')
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function submitDeleteForm(e) {
        e.preventDefault();
        let deleteForm = document.querySelector('#deleteForm');
        deleteForm.submit();
    }
 </script>