@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $schedule->client }}</p>

            @foreach ($schedule->services as $service)
                <p class="card-text"><a href="{{ $service->link() }}">{{ $service->title }}</a></p>
            @endforeach

            <p class="card-text">{{ $schedule->schedule }}</p>

            @if ($schedule->payment) 
                <p class="card-text"><a href="{{ $schedule->payment->link() }}">Pago R${{ $schedule->payment->value }}</a></p>
            @else
                <p class="card-text">Aguardando Pagamento</p>
            @endif

            @if ($schedule->archived_at)
                <p class="card-text">Arquivado em: {{ $schedule->archived_at }}</p>
            @endif
            <p class="card-text mr-4">{{ $schedule->description }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <div>
                        @unless ($schedule->archived_at)
                            <a href={{ $schedule->link() . "/edit" }}>Editar</a>

                            <a class="ml-4" href={{ $schedule->link() . "/archive" }}>Arquivar</a>

                            @unless ($schedule->payment)
                                <a href="/" onclick="openCreatePaymentModal(event)" class="ml-4">Pagar</a>
                                <button id="open-modal-button" type="button" class="hidden" data-toggle="modal" data-target="#create-payment-modal">
                                </button>
                            @endunless 
                        @endunless

                    </div>
                    <a href="/" onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
                </div>
            </p>
            <form id="deleteForm" action="{{ $schedule->link() }}" method="POST">
                @method('DELETE')
                @csrf
            </form>

            <div class="modal fade" id="create-payment-modal" tabindex="-1" role="dialog" aria-labelledby="create-payment-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Criar Pagamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/payments" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="client">Valor*</label> 
                                <div class="input-group">
                                    <input class="form-control" type="number" name="value" placeholder="Valor total" value={{ $schedule->services()->sum('price') }}>
                                </div>
                
                                <label for="type">Tipo*</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="-1" disabled selected hidden>Selecione o tipo de Pagamento</option>
                                    @foreach($payment_types as $index => $payment_type)
                                        <option value="{{ $index }}">{{ $payment_type }}</option>
                                    @endforeach
                                </select>
                
                                <input class="form-control" type="number" name="schedule_id" value={{ $schedule->id }} hidden>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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

    function openCreatePaymentModal(e) {
        e.preventDefault();
        let openModalButton = document.querySelector('#open-modal-button');
        openModalButton.click();
    }
 </script>
