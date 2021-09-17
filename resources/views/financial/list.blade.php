@extends('layouts.admin-master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@section('page-title', trans('app.financial'))
@section('page-heading', trans('app.financial'))

@section('breadcrumbs')
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{ route('user.list') }}">@lang('app.administration')</a>
    </div>
    <div class="breadcrumb-item">@lang('app.financial')</div>
</div>
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Expenses by lab and month this year
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="expensesChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Profit by lab and month this year
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="profitChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Cash flow OPEX & CAPEX
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="cashFlowChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Revenue by month this year
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="revenueChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
        $("#status").change(function() {
            $("#users-form").submit();
        });

        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

        // Expenses chart
        new Chart("expensesChart", {
            type: "line",
            data: {
                labels: months,
                datasets: [
                    {
                        data: [
                            1768,
                            3588,
                            7800,
                            4278,
                            7552,
                            6901,
                            3972,
                            8438,
                            5769,
                            8481,
                            1000,
                            6185,
                        ],
                        borderColor: "#A644BB",
                        fill: false,
                        label: "Labs A",
                    },
                    {
                        data: [
                            6817,
                            8835,
                            1178,
                            7842,
                            5275,
                            1169,
                            7239,
                            3884,
                            6957,
                            8184,
                            8810,
                            8561,
                        ],
                        borderColor: "#BBA644",
                        fill: false,
                        label: "Labs B",
                    },
                    {
                        data: [
                            8561,
                            1868,
                            7248,
                            5882,
                            9262,
                            7410,
                            1010,
                            2750,
                            6957,
                            8184,
                            5023,
                            4891,
                        ],
                        borderColor: "#44BBA6",
                        fill: false,
                        label: "Labs C",
                    },
                ]
            },
        });

        // Profit chart
        new Chart("profitChart", {
            type: "line",
            data: {
                labels: months,
                datasets: [
                    {
                        data: [
                            17680,
                            35885,
                            78001,
                            42783,
                            75524,
                            69019,
                            39723,
                            84385,
                            57690,
                            84817,
                            10007,
                            61851,
                        ],
                        borderColor: "#80bfff",
                        fill: false,
                        label: "Labs A",
                    },
                    {
                        data: [
                            23502,
                            91486,
                            82589,
                            10747,
                            10007,
                            61851,
                            68086,
                            62924,
                            48729,
                            50273,
                            57690,
                            84817,
                        ],
                        borderColor: "#cc99ff",
                        fill: false,
                        label: "Labs B",
                    },
                    {
                        data: [
                            61851,
                            68086,
                            48729,
                            82589,
                            62924,
                            10747,
                            10007,
                            50273,
                            57690,
                            84817,
                            23502,
                            91486,
                        ],
                        borderColor: "#0066cc",
                        fill: false,
                        label: "Labs C",
                    },
                ]
            },
        });

        // Cash flow apex & copex chart
        new Chart("cashFlowChart", {
            type: "bar",
            data: {
                labels: months,
                datasets: [
                    {
                        data: [
                            23502,
                            91486,
                            82589,
                            10747,
                            10007,
                            61851,
                            68086,
                            62924,
                            48729,
                            50273,
                            57690,
                            84817,
                        ],
                        backgroundColor: "#7ECD32",
                        fill: false,
                        label: "OPEX",
                    },
                    {
                        data: [
                            61851,
                            68086,
                            48729,
                            82589,
                            62924,
                            10747,
                            10007,
                            50273,
                            57690,
                            84817,
                            23502,
                            91486,
                        ],
                        backgroundColor: "#327ECD",
                        fill: false,
                        label: "CAPEX",
                    },
                ]
            },
        });

        // Revenue chart
        new Chart("revenueChart", {
            type: "bar",
            data: {
                labels: months,
                datasets: [
                    {
                        data: [
                            17680,
                            35885,
                            23502,
                            91486,
                            82589,
                            30747,
                            20007,
                            61851,
                            57690,
                            84817,
                            23502,
                            91486,
                        ],
                        backgroundColor: "#B4CD32",
                        fill: false,
                        label: "Labs A",
                    },
                ]
            },
            options: {
                legend: {display: false}
            }
        });
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}
@stop