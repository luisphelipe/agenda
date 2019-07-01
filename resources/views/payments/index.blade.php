@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            <h4 class="card-title mb-4">Pesquisa e filtros</h4>
        </div>
    </div> --}}
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <h4 class="card-title mb-4">Pagamentos</h4>
            @foreach ($payments as $payment)
                <div class="d-flex justify-content-between">
                    <p><a href={{ $payment->link() }}>{{ $payment->schedule->client }}</a> - {{ 'R$' . $payment->value }}</p>
                    {{-- <p class="mr-4"><a href={{ $payment->link() . "/edit" }}>Editar</a></p> --}}
                </div>
            @endforeach
        </div>

        <div id="pagination" class="d-flex justify-content-around">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
