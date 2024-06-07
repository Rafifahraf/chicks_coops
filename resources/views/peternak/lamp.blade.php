@extends('layout.layout_peternak')
@section('title', 'lamp')
@section('container')
    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center"
            role="alert">
            {{ session('message') }}
            <button type="button" class="close btn m-0 p-0 btn-primary-outline text-warning" style="font-size: 1.5rem"
                data-dismiss="alert" onclick="$('.alert').alert('close')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card w-100">
        <div class="card-body p-4">
            <div style="display: flex; justify-content:space-between">
                <h5 class="card-title fw-semibold mb-4">Lamp Configuration</h5>
                {{-- <a href="/lamp/create" class="btn btn-warning">Add Configuration</a> --}}
            </div>
            {{-- {{$datas_config_lamp}} --}}
            <div class="table-responsive" data-simplebar>
                <table class="table text-nowrap align-middle table-custom mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-dark fw-normal ps-0">Device
                            </th>
                            <th scope="col" class="text-dark fw-normal">Status</th>
                            <th scope="col" class="text-dark fw-normal">Time On</th>
                            <th scope="col" class="text-dark fw-normal">Time Off</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas_config_lamp as $data)
                            <tr>
                                <td class="ps-0">
                                    <span>Breeder- {{ $data->device_id }} </span>
                                </td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="badge bg-secondary-subtle text-secondary">on</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">off</span>
                                    @endif
                                </td>
                                <td>
                                    <span> {{ $data->time_on }} </span>
                                </td>
                                <td>
                                    <span>{{ $data->time_off }}</span>
                                </td>
                                <td>
                                    <a href="/lamp/{{ $data->id }}/edit" class="btn btn-success">Edit</a>
                                </td>
                                {{-- <td>
                                    <form action="/lamp/{{ $data->id }}" method='POST'>
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>

                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
