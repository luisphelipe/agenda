@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="/schedules" method="POST">
                @csrf

                <label for="client">Cliente*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="client" placeholder="Selecione a cliente" value={{ old('client') }}>
                </div>

                <div id="all-services">
                    <label for="services[0]">Servico*</label>
                    <div id="service-wrapper-0" class="input-group">
                        <select class="form-control" id="services[0]" name="services[0]" required>
                            <option value="-1" disabled selected hidden>Selecione um servico</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>

                        <img src="{{ URL::to('/') }}/plus.png" class="ml-1 mt-auto mb-auto" style="width: 1.5rem; height: 1.5rem" onclick="addServiceInput()" />
                    </div>

                    <div id="additional-service-wrapper" class="input-group mt-2 hidden">
                        <select class="form-control">
                            <option value="" disabled selected hidden>Selecione um servico</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                        <img src="{{ URL::to('/') }}/subtract.png" class="ml-1 mt-auto mb-auto hidden" style="width: 1.5rem; height: 1.5rem" onclick="removeAdditionalServiceInput()" />
                    </div>
                </div>

                <label for="schedule">Data*</label>
                <div class="input-group">
                    <input type="datetime-local" class="form-control" name="schedule" value={{ old('schedule') }}>
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Agendar Cliente</button>
                <a href="/schedules" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    let serviceNumber = 1;

    function addServiceInput() {
        let serviceContainer = document.querySelector('#all-services'),
            additionalServiceInput = document.querySelector('#additional-service-wrapper').cloneNode(true);

        let actualInput = additionalServiceInput.querySelector('select');

        additionalServiceInput.id = 'additional-service-wrapper-' + serviceNumber;
        actualInput.name = `services[${serviceNumber}]`;

        if (serviceNumber === 1) {
            let minusButton = additionalServiceInput.querySelector('img');
            minusButton.classList.toggle('hidden');
        }

        serviceContainer.appendChild(additionalServiceInput);
        additionalServiceInput.classList.toggle('hidden');

        serviceNumber++;
    }

    function removeAdditionalServiceInput() {
        let serviceContainer = document.querySelector('#all-services'),
            lastServiceInput = serviceContainer.querySelector('#additional-service-wrapper-' + (serviceNumber - 1));

        serviceContainer.removeChild(lastServiceInput);

        serviceNumber--;
    }
</script>
