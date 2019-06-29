@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $schedule->client }}</p>
            <p class="card-text">{{ $schedule->service }}</p>
            <p class="card-text">{{ $schedule->schedule }}</p>
            @if ($schedule->archived_at)
                <p class="card-text">Arquivado em: {{ $schedule->archived_at }}</p>
            @endif
            <p class="card-text mr-4">{{ $schedule->description }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href={{ $schedule->link() . "/edit" }}>Editar</a>
                        @unless ($schedule->archived_at)
                            <a class="ml-4" href={{ $schedule->link() . "/archive" }}>Arquivar</a>
                        @endunless
                    </div>
                    <a href="/" onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
                </div>
            </p>
            <form id="deleteForm" action="{{ $schedule->link() }}" method="POST">
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