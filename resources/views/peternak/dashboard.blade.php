@extends('layout.layout_peternak')
@section('title', 'Dashboard Breeder')
@section('container')


    <!--  Row 1 -->
    <div class="row ">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-6 mb-4 ">
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                            <iconify-icon icon="solar:water-linear" class="fs-6 text-secondary">
                            </iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4">Humidity</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-6">
                        <h6 class="mb-0 fw-medium"></h6>
                        <h6 class="mb-0 fw-medium">83%</h6>
                    </div>
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                        aria-valuemax="100" style="height: 5px;">
                        <div class="progress-bar bg-secondary" style="width: 83%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-6 mb-4 ">
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                            <iconify-icon icon="solar:temperature-outline" class="fs-6 text-danger"></iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4">Temperature</h6>
                    </div>
                    <div class="">
                        <h2 class="fs-11 text-success fw-semibold m-0">30 &#8451;</h2>
                        <span class="fs-11 text-success fw-semibold"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-6 mb-4">
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-warning-subtle">
                            <iconify-icon icon="solar:lightbulb-linear" class="fs-6 text-warning"></iconify-icon>
                        </span>
                        <h6 class="mb-0 fs-4">Light Intensity</h6>
                    </div>
                    <div class="">
                        <h2 class="fs-11 text-success fw-semibold m-0">30 Lux</h2>
                        <span class="fs-11 text-success fw-semibold"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row">
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-6 ">
                            <span class="round-48 d-flex align-items-center justify-content-center rounded bg-warning-subtle">
                                <h1 class="fs-6 text-warning">ON</h1>
                            </span>
                            <h6 class="mb-0 fs-4">Heater</h6>
                        </div>

                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-6 ">
                            <span class="round-48 d-flex align-items-center justify-content-center rounded bg-warning-subtle">
                                <h1 class="fs-6 text-warning">ON</h1>
                            </span>
                            <h6 class="mb-0 fs-4">Lamp</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Light Intensity</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">Light</option>
                                <option value="2">Humidity</option>
                                <option value="3">Temperature</option>
                            </select>
                        </div>
                    </div>
                    <div id="revenue-forecast"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- row-2 --}}
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Activity Log</h5>
                    <div class="table-responsive" data-simplebar>
                        <table class="table text-nowrap align-middle table-custom mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-dark fw-normal ps-0">Log name
                                    </th>
                                    <th scope="col" class="text-dark fw-normal">Description</th>
                                    <th scope="col" class="text-dark fw-normal">Causer id</th>
                                    <th scope="col" class="text-dark fw-normal">Causer Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{-- <img src="{{ asset('images/products/dash-prd-1.jpg') }}" alt="prd1"
                                                        width="48" class="rounded" /> --}}
                                            <div>
                                                <h6 class="mb-0">Jason Roy</h6>
                                                {{-- <span>Jason Roy</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>73.2%</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success">Low</span>
                                    </td>
                                    <td>
                                        <span class="text-dark">$3.5k</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{-- <img src="{{ asset('images/products/dash-prd-2.jpg') }}" alt="prd1"
                                                        width="48" class="rounded" /> --}}
                                            <div>
                                                <h6 class="mb-0">Mathew Flintoff</h6>
                                                {{-- <span>Mathew Flintoff</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>73.2%</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning-subtle text-warning">Medium</span>
                                    </td>
                                    <td>
                                        <span class="text-dark">$3.5k</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{-- <img src="{{ asset('images/products/dash-prd-3.jpg') }}" alt="prd1"
                                                        width="48" class="rounded" /> --}}
                                            <div>
                                                <h6 class="mb-0">Anil Kumar</h6>
                                                {{-- <span>Anil Kumar</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>73.2%</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Very
                                            High</span>
                                    </td>
                                    <td>
                                        <span class="text-dark">$3.5k</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{-- <img src="{{ asset('images/products/dash-prd-4.jpg') }}" alt="prd1"
                                                        width="48" class="rounded" /> --}}
                                            <div>
                                                <h6 class="mb-0">George Cruize</h6>
                                                {{-- <span>George Cruize</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>73.2%</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-danger">High</span>
                                    </td>
                                    <td>
                                        <span class="text-dark">$3.5k</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                        class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
            </div> --}}
    @endsection
