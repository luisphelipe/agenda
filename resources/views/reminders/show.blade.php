@extends('layouts.app')

@section('custom-links')
    @include('reminders.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $reminder->text }}</p>
            <p class="card-text">{{ $reminder->date ? $reminder->formattedDate() : 'Data nao especificada' }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <a href={{ $reminder->link() . "/edit" }}>Editar</a>
                    <a href={{ $reminder->link() }} onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
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