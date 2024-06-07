@extends('layout.layout_admin')
@section('title', 'device')
@section('container')
    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
            {{ session('message') }}
            <button type="button" class="close btn m-0 p-0 btn-primary-outline text-warning" style="font-size: 1.5rem" data-dismiss="alert" onclick="$('.alert').alert('close')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card w-100">
        <div class="card-body p-4">
            <div style="display: flex; justify-content:space-between">
                <h5 class="card-title fw-semibold mb-4">This is Device Data</h5>
                <a href="/admin/device/create" class="btn btn-warning">Add Devices</a>
            </div>
            <div class="table-responsive" data-simplebar>
                <table class="table text-nowrap align-middle table-custom mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-dark fw-normal ps-0">User
                            </th>
                            <th scope="col" class="text-dark fw-normal">Device id</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_device as $data)
                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center gap-6">
                                        {{-- <img src="{{$data->avatar}}" alt="prd1" width="48"
                                        class="rounded" /> --}}
                                        <div>
                                            <h6 class="mb-0">{{ $data->user->name }}</h6>
                                            {{-- <span>{{}}</span> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span> Breeder-{{ $data->id }}</span>
                                </td>
                                <td>
                                    <a href="/admin/device/{{ $data->id }}/edit" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <form action="/admin/device/{{ $data->id }}" method='POST'>
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
