@extends('layout.layout_admin')
@section('title', 'Admin')
@section('container')

    <div class="card w-100">
        <div class="card-body p-4">
            <div style="display: flex; justify-content:space-between">
                <h5 class="card-title fw-semibold mb-4">This is Users Data</h5>
                <a href="/admin/user/create" class="btn btn-warning">Add Users</a>
            </div>
            <div class="table-responsive" data-simplebar>
                <table class="table text-nowrap align-middle table-custom mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-dark fw-normal ps-0">Name and Avatar
                            </th>
                            <th scope="col" class="text-dark fw-normal">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_user as $data)

                            <tr>
                                <td class="ps-0">
                                    <div class="d-flex align-items-center gap-6">
                                        <img src="{{$data->avatar}}" alt="prd1"
                                            width="48" class="rounded" />
                                        <div>
                                            <h6 class="mb-0">{{$data->name}}</h6>
                                            <span>
                                                @if ($data->is_admin)
                                                    Admin
                                                    @else
                                                    Breeder
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>{{$data->email}}</span>
                                </td>
                                <td>
                                    <a href="/admin/user/{{$data->id}}/edit" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <form action="/admin/user/{{ $data->id }}" method='POST'>
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
