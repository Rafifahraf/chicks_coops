@extends('layout.layout_peternak')
@section('title', 'heater')
@section('container')
    <div class="body-wrapper-inner">
        <div style="gap: 1rem; display: flex; flex-direction: column;" class="container-fluid">
            @foreach ($data as $item)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Heater Configuration Breeder-{{ $item->devices->id }}</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        {{ $item->mode == 'automatic' ? 'checked' : null }}
                                        id="automatic{{ $item->id }}"
                                        onclick="onAuthomaticPressed({{ $item->id }})">
                                    <label id="automaticLabel{{ $item->id }}" class="form-check-label"
                                        for="flexSwitchCheckDefault">{{ $item->mode == 'automatic' ? 'Authomatic' : 'Manual' }}</label>
                                </div>
                                <div id="ManualForm{{ $item->id }}"
                                    class="form-check form-switch @if ($item->mode != 'manual') d-none @endif">
                                    <input {{ $item->status ? 'checked' : null }}
                                        {{ $item->mode == 'automatic' ? 'disabled' : null }} class="form-check-input"
                                        type="checkbox" role="switch" id="ison{{ $item->id }}"
                                        onclick="onCheckPressed({{ $item->id }})">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"
                                        id="isonlabel{{ $item->id }}">{{ $item->status ? 'ON' : 'OFF' }}</label>
                                </div>
                                <div id="AutoForm{{ $item->id }}"
                                    class="row @if ($item->mode != 'automatic') d-none @endif">
                                    <div class="col">
                                        <label for="min_val{{ $item->id }}" class="form-label">Min Temprerature</label>
                                        <input type="number" value="{{ $item->min_temp }}" class="form-control"
                                            id="min_val{{ $item->id }}">
                                    </div>
                                    <div class="col">
                                        <label for="max_val{{ $item->id }}" class="form-label">Max Temperature</label>
                                        <input type="number" class="form-control" value="{{ $item->max_temp }}"
                                            id="max_val{{ $item->id }}">
                                    </div>
                                    <div class="col d-flex align-items-end">
                                        <button onclick="onSubmitMaxMinVal({{ $item->id }})"
                                            class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function onSubmitMaxMinVal(id) {
            let min_temp = document.getElementById('min_val' + id).value
            let max_temp = document.getElementById('max_val' + id).value

            if (max_temp < min_temp) {
                window.alert('Min Temperature can\'t bigger than Max Temperature')
            } else {
                updateData(id, {
                    min_temp: min_temp,
                    max_temp: max_temp
                })
                window.alert('Temperature boundary has been updated')
            }

        }

        function onCheckPressed(id) {
            let switch_btn = document.getElementById('ison' + id);
            let switch_label = document.getElementById('isonlabel' + id);
            if (switch_btn.checked) {
                switch_label.innerHTML = "ON"
                updateData(id, {
                    status: 1
                })
            } else {
                switch_label.innerHTML = "OFF"
                updateData(id, {
                    status: 0
                })
            }
        }

        function onAuthomaticPressed(id) {
            let switch_mode = document.getElementById('automatic' + id)
            let mode_label = document.getElementById('automaticLabel' + id)
            let switch_btn = document.getElementById('ison' + id);
            let form_manual = document.getElementById('ManualForm' + id)
            let form_auto = document.getElementById('AutoForm' + id)
            if (switch_mode.checked) {
                mode_label.innerHTML = 'Automatic'
                switch_btn.setAttribute('disabled', "")
                form_manual.classList.add('d-none')
                form_auto.classList.remove('d-none')
                updateData(id, {
                    mode: 'automatic'
                })
            } else {
                mode_label.innerHTML = 'Manual'
                switch_btn.removeAttribute('disabled')
                form_manual.classList.remove('d-none')
                form_auto.classList.add('d-none')
                updateData(id, {
                    mode: 'manual'
                })
            }
        }

        function updateData(id, data) {
            let datasend = {
                ...data
            }
            console.log(datasend)
            fetch(`api/config_heater/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(datasend)
            }).then((res) => {
                console.log(res.json())
            })
        }
    </script>
@endsection
