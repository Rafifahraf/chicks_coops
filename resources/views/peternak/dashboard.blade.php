@extends('layout.layout_peternak')
@section('title', 'Dashboard Breeder')
@section('container')
    <!--  Row 1 -->
    <div class="row gap-3">
        <div class="col-lg card">
            <div class="card-body d-flex flex-column justify-content-center gap-6">
                <div class="d-flex align-items-center gap-6 mb-4 ">
                    <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                        <iconify-icon icon="solar:temperature-outline" class="fs-6 text-danger"></iconify-icon>
                    </span>
                    <h6 class="mb-0 fs-4">Temperature</h6>
                </div>
                <div class="">
                    <h2 class="fs-11 text-danger fw-semibold m-0">{{ $DataSensor->last()->temperature ?? 0 }} &#8451;</h2>

                </div>
            </div>
        </div>
        <div class="col-lg card">
            <div class="card-body d-flex flex-column justify-content-center gap-6">
                <div class="d-flex align-items-center gap-6 mb-4 ">
                    <span class="round-48 d-flex align-items-center justify-content-center rounded bg-secondary-subtle">
                        <iconify-icon icon="solar:water-linear" class="fs-6 text-secondary">
                        </iconify-icon>
                    </span>
                    <h6 class="mb-0 fs-4">Humidity</h6>
                </div>

                <div class="">
                    <h2 class="fs-11 text-info fw-semibold m-0">{{ $DataSensor->last()->humidity ?? 0 }} %</h2>

                </div>
                {{-- <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                    aria-valuemax="100" style="height: 5px;">
                    <div class="progress-bar bg-secondary" style="width: {{ $DataSensor->last()->humidity ?? 0 }}%"></div>
                </div> --}}
            </div>
        </div>
        <div class="col-lg card">
            <div class="card-body d-flex flex-column justify-content-center gap-6">
                <div class="d-flex align-items-center gap-6 mb-4">
                    <span class="round-48 d-flex align-items-center justify-content-center rounded bg-warning-subtle">
                        <iconify-icon icon="solar:lightbulb-linear" class="fs-6 text-warning"></iconify-icon>
                    </span>
                    <h6 class="mb-0 fs-4">Light Intensity</h6>
                </div>
                <div class="">
                    <h2 class="fs-11 text-warning fw-semibold m-0">{{ $DataSensor->last()->light_intensity ?? 0 }} Lux</h2>

                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-6 ">
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-info-subtle">
                            <h1 class="fs-6 m-0 text-info">ON</h1>
                        </span>
                        <h6 class="mb-0 fs-4">Heater</h6>
                    </div>

                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-6 ">
                        <span class="round-48 d-flex align-items-center justify-content-center rounded bg-danger-subtle">
                            <h1 class="fs-6 m-0 text-danger">OFF</h1>
                        </span>
                        <h6 class="mb-0 fs-4">Lamp</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- grafik --}}
    <div class="row ">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Data Chart</h5>
                        </div>
                        {{-- <div>
                            <select class="form-select">
                                <option value="1">All</option>
                                <option value="2">Light</option>
                                <option value="3">Humidity</option>
                                <option value="4">Temperature</option>
                            </select>
                        </div> --}}
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
                                    <th scope="col" class="text-dark fw-normal">Created</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Log as $data )
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center gap-6">
                                            {{-- <img src="{{ asset('images/products/dash-prd-1.jpg') }}" alt="prd1"
                                                        width="48" class="rounded" /> --}}
                                            <div>
                                                <h6 class="mb-0">{{$data->log_name}}</h6>
                                                {{-- <span>Jason Roy</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>{{$data->description}}</span>
                                    </td>

                                    <td>
                                        <span class="text-dark">{{$data->created_at}}</span>
                                    </td>
                                </tr>
                                @endforeach


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
    @section('script')
        {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}

        <script>

            $(function() {


                // -----------------------------------------------------------------------
                // Subscriptions
                // -----------------------------------------------------------------------
                var chart = {
                    series: [{
                            name: "Light Intencity",
                            data: [
                                @foreach ($DataSensor as $data)
                                    {{ $data->light_intensity . ',' }}
                                @endforeach
                            ],
                        },
                        {
                            name: "Temperature",
                            data: [
                                @foreach ($DataSensor as $data)
                                    {{ $data->temperature . ',' }}
                                @endforeach
                            ],
                        },
                        {
                            name: "Humidity",
                            data: [
                                @foreach ($DataSensor as $data)
                                    {{ $data->humidity . ',' }}
                                @endforeach
                            ],
                        },
                    ],
                    chart: {
                        toolbar: {
                            show: false,
                        },
                        type: "line",
                        fontFamily: "inherit",
                        foreColor: "#adb0bb",
                        height: 270,
                        stacked: true,
                        offsetX: -15,
                    },
                    colors: ["var(--bs-warning)", "var(--bs-danger)", "var(--bs-info)"],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            barHeight: "60%",
                            columnWidth: "15%",
                            borderRadius: [6],
                            borderRadiusApplication: "end",
                            borderRadiusWhenStacked: "all",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: false,
                    },
                    grid: {
                        show: true,
                        padding: {
                            top: 0,
                            bottom: 0,
                            right: 0,
                        },
                        borderColor: "rgba(0,0,0,0.05)",
                        xaxis: {
                            lines: {
                                show: true,
                            },
                        },
                        yaxis: {
                            lines: {
                                show: true,
                            },
                        },
                    },
                    yaxis: {
                        min: -5,
                        max: 5,
                    },
                    xaxis: {
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        categories:[
                            @foreach ($DataSensor as $data)
                                    "{{ $data->created_at }}",
                                @endforeach
                        ],

                        labels: {
                            style: {
                                fontSize: "13px",
                                colors: "#adb0bb",
                                fontWeight: "400"
                            },
                        },
                    },
                    yaxis: {
                        tickAmount: 4,
                    },
                    tooltip: {
                        theme: "dark",
                    },
                };

                var chart = new ApexCharts(
                    document.querySelector("#revenue-forecast"),
                    chart
                );
                chart.render();



            })
        </script>

    @endsection
