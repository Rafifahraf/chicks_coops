@extends('layout.layout_peternak')
@section('title', 'heater')
@section('container')
    <div class="body-wrapper-inner">
        <div style="gap: 1rem; display: flex; flex-direction: column;" class="container-fluid">
            @foreach ($data as $item)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Heater Configuration Breeder-{{$item->devices->id}}</h5>
                        <div class="card">
                            <div class="card-body">
                                <form>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            {{$item->mode=='automatic'?'checked':null}}
                                            id="automatic{{$item->id}}" onclick="onAuthomaticPressed({{$item->id}})" >
                                        <label id="automaticLabel{{$item->id}}" class="form-check-label" for="flexSwitchCheckDefault">{{$item->mode=='automatic'?'Authomatic':'Manual'}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input {{$item->status?'checked':null}} {{$item->mode=='automatic'?'disabled':null}} class="form-check-input" type="checkbox" role="switch" id="ison{{$item->id}}"
                                            onclick="onCheckPressed({{$item->id}})">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"
                                            id="isonlabel{{$item->id}}">{{$item->status?'ON':'OFF'}}</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function onCheckPressed(id) {
            let switch_btn = document.getElementById('ison'+id);
            let switch_label = document.getElementById('isonlabel'+id);
            if (switch_btn.checked) {
                switch_label.innerHTML = "ON"
            } else {
                switch_label.innerHTML = "OFF"
            }
        }

        function onAuthomaticPressed(id){
            let switch_mode = document.getElementById('automatic'+id)
            let mode_label = document.getElementById('automaticLabel'+id)
            let switch_btn = document.getElementById('ison'+id);
            if(switch_mode.checked){
                mode_label.innerHTML = 'Automatic'
                switch_btn.setAttribute('disabled',"")
            }else{
                mode_label.innerHTML = 'Manual'
                switch_btn.removeAttribute('disabled')
            }
        }

    </script>
@endsection
