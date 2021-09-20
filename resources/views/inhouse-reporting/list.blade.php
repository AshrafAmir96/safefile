@extends('layouts.admin-master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@section('page-title', trans('app.reporting'))
@section('page-heading', trans('app.reporting'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.in_house')</div>
        <div class="breadcrumb-item">@lang('app.reporting')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                

                <div class="col-md-2 mt-2 mt-md-0">
                    {!! Form::select('test_type', $test_types, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    {!! Form::select('lab_type', $allocation_types, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('status', $validation_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('lab_type', $approval_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                
            </div>
        </form>
        <div class="row">
            <div class="col-md-7 mt-2 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="pt-4 px-3">
                            <canvas id="donut" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-2 mt-md-0">
                <div class="card">
                  
                    <div class="card-body">
                        <div class="pt-4 px-3">
                            <canvas id="donut2" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card">
                  
                    <div class="card-body">
                        <div class="pt-4 px-3">
                            <canvas id="donut3" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Registration by Month
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="multi_graph" height="200"></canvas>
                </div>
            </div>
        </div>
        
    </div>
</div>

{!! $users->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });

        var xValues = ["New registration", "Approved", "Rejected", "In Validation Process"];
        var yValues = [100,41,24,13];
        var barColors = [
        "#80bfff",
        "#00b300",
        "#cc99ff",
        "#ff6666"
        ];

        new Chart("donut", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Number Of Registration"
            }
        }

        });


        var xValues2 = ["Urgent", "Normal"];
        var yValues2 = [141,37];
        var barColors2 = [
        "#66ff66",
        "#ff6600"
        ];

        new Chart("donut2", {
        type: "doughnut",
        data: {
            labels: xValues2,
            datasets: [{
            backgroundColor: barColors2,
            data: yValues2
            }]
        },
        options: {
            title: {
            display: true,
            text: "Sample Allocation Type"
            }
        }

        });

        var xValues3 = ["New registration", "Approved", "Rejected", "In Validation Process"];
        var yValues3 = [100,41,24,13];
        var barColors3 = [
        "#80bfff",
        "#00b300",
        "#cc99ff",
        "#ff6666"
        ];

        new Chart("donut3", {
        type: "doughnut",
        data: {
            labels: xValues3,
            datasets: [{
            backgroundColor: barColors3,
            data: yValues3
            }]
        },
        options: {
            title: {
            display: true,
            text: "Number Of Registration"
            }
        }

        });


        var xValues = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

        new Chart("multi_graph", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            data: [2,1,5,23,12,1,12,3,4],
            borderColor: "#ff3300",
            fill: false
            }]
        },
        options: {
            legend: {display: false}
        }
        });


    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}
@stop
