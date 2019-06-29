@extends('layouts.app')

@section('custom-links')
    @include('services.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $service->title }}</p>
            <p class="card-text">{{ $service->price }}</p>
            <p class="card-text">{{ $service->duration }}</p>
            <p class="card-text mr-4">{{ $service->description }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href={{ $service->link() . "/edit" }}>Editar</a>
                    </div>
                    <a href="/" onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
                </div>
            </p>
            <form id="deleteForm" action="{{ $service->link() }}" method="POST">
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