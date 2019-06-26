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
            <p class="card-text">{{ $schedule->formattedSchedule() }}</p>
            <p class="card-text">{{ $schedule->description }}</p>
            <p><a href={{ $schedule->link() . "/edit" }}>Editar</a></p>
            <form action="{{ $schedule->link() }}" method="POST">
                @method('DELETE')
                @csrf
            
                <button type="submit" class="btn btn-link" style="padding: 0px; margin: 0px; border: 0px">Excluir</button>
            </form>
        </div>
    </div>
</div>
@endsection
