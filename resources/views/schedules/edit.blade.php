@extends('layouts.app')

@section('custom-links')
    @include('schedules.__links')
@endsection

@section('content')
<div class="container">
    <div class="card w-100 pl-2 pt-1 mb-2">
        <div class="card-body">
            @include ('layouts.errors')
            
            <form action="{{ $schedule->link() }}" method="POST">
                @method('PUT')
                @csrf

                <label for="client">Cliente*</label> 
                <div class="input-group">
                    <input class="form-control" type="text" name="client" placeholder="Selecione a cliente" value="{{ $schedule->client }}">
                </div>

                <div id="all-services">
                    <label for="services[0]">Servico*</label>

                    @foreach ($schedule->services as $index => $schedule_service)
                    <div id="{{ $index > 0 ? 'additional-' : '' }}service-wrapper-{{ $index }}" class="input-group">
                            <select class="form-control {{ $index > 0 ? 'mt-2' : '' }}" id="services[{{ $index }}]" name="services[{{ $index }}]" required>
                                @foreach($services as $service)
                                    @if ($service->id == $schedule_service->id)
                                        <option value="{{ $service->id }}" selected>{{ $service->title }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($index == 0) 
                                <img src="{{ URL::to('/') }}/plus.png" class="ml-1 mt-auto mb-auto" style="width: 1.5rem; height: 1.5rem" onclick="addServiceInput()" />
                            @endif

                            @if ($index == 1) 
                                <img src="{{ URL::to('/') }}/subtract.png" class="ml-1 mt-auto mb-auto" style="width: 1.5rem; height: 1.5rem" onclick="removeAdditionalServiceInput()" />
                            @endif

                        </div>
                    @endforeach

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
                    <input type="datetime-local" class="form-control" name="schedule" value="{{ $schedule->formFriendlySchedule() }}">
                </div>

                <label for="description">Descrição</label>
                <div class="input-group mb-4">
                    <textarea class="form-control" name="description" rows="3">{{ $schedule->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Editar Agendamento</button>
                <a href="{{ $schedule->link() }}" class="ml-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    let serviceNumber = {{ $schedule->services->count() }};

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
        if (serviceNumber <= 1) return;

        let serviceContainer = document.querySelector('#all-services'),
            lastServiceInput = serviceContainer.querySelector('#additional-service-wrapper-' + (serviceNumber - 1));

        serviceContainer.removeChild(lastServiceInput);

        serviceNumber--;
    }
</script>
