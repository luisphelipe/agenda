@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1">
        <div class="card-body">
            <p class="card-text">{{ $payment->schedule->client }}</p>
            <p class="card-text"><a href="{{ $payment->schedule->link() }}">{{ $payment->schedule->schedule }}</a></p>
            <p class="card-text">R$ {{ $payment->value }}</p>
            <p class="card-text">{{ $payment->type }}</p>

            <p>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/" onclick="openEditPaymentModal(event)">Editar</a>
                        <button id="edit-modal-button" type="button" class="hidden" data-toggle="modal" data-target="#edit-payment-modal">
                        </button>
                    </div>
                    <a href="/" onclick="submitDeleteForm(event)" class="mr-4 red-link">Excluir</a>
                </div>
            </p>
            <form id="deleteForm" action="{{ $payment->link() }}" method="POST">
                @method('DELETE')
                @csrf
            </form>

            <div class="modal fade" id="edit-payment-modal" tabindex="-1" role="dialog" aria-labelledby="edit-payment-modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Pagamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ $payment->link() }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="modal-body">
                                <label for="client">Valor*</label> 
                                <div class="input-group">
                                    <input class="form-control" type="number" name="value" placeholder="Valor total" value={{ $payment->value }}>
                                </div>
                
                                <label for="type">Tipo*</label>
                                <select class="form-control" id="type" name="type" required>
                                    @foreach($payment_types as $index => $payment_type)
                                        <option value="{{ $index }}" {{ $payment->type == $payment_type ? 'selected' : '' }}>{{ $payment_type }}</option>
                                    @endforeach
                                </select>
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

    function openEditPaymentModal(e) {
        e.preventDefault();
        let openModalButton = document.querySelector('#edit-modal-button');
        openModalButton.click();
    }
 </script>