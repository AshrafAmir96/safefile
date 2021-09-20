@extends('layouts.admin-master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@section('page-title', trans('app.csi'))
@section('page-heading', trans('app.csi'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.user_interface')</div>
        <div class="breadcrumb-item">@lang('app.csi')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('test_type', $test_types, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                
            </div>
        </form>
        <div class="row">
            <div class="col-md-7 mt-2 mt-md-0">
                
                <div class="pt-4 px-3 text-center">
                    <h1>Total Satisfaction</h1>
                    <h2>152</h2>
                </div>
                  

                <div class="card">
                    <div class="card-body">
                        <div class="pt-4 px-3">
                            <canvas id="donut" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                   
                    <th class="min-width-150">Name</th>
                    <th class="min-width-100">Satisfaction</th>
                   
                    <th class="min-width-80">Remarks</th>
                    <th class="min-width-150">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                         <tr>
                            <td> <a href="#">Customer 1</a></td>
                            <td> Positive</td>
                          
                            <td> Very easy to use<br> and good staff</td>
                          
                            
                            <td>

                            <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="View Details"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-search"></i>
                                </a>
                                
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Contact Number"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-phone"></i>
                                </a>

                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Email"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-envelope"></i>
                                </a>

                            </td>
                        </tr>
                       
                    @else
                        <tr>
                            <td colspan="7"><em>@lang('app.no_records_found')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
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

        
        
    </div>
</div>

{!! $users->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });

        var xValues = ["Positive", "Negative", "Neutral"];
        var yValues = [120,12,20];
        var barColors = [
        "#33cc33",
        "#ff0000",
        "#999999"
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
            text: "Number Of Satifaction"
            }
        }

        });


        var xValues2 = ["System", "Staff","Both"];
        var yValues2 = [10,10,100];
        var barColors2 = [
        "#ff4da6",
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
            text: "Factor Positive Satisfaction"
            }
        }

        });

        var xValues3 = ["System", "Staff", "Both"];
        var yValues3 = [4,2,6];
        var barColors3 = [
        "#80bfff",
        "#00b300",
        "#cc99ff"
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
            text: "Factor Bad Satisfaction"
            }
        }

        });


       


    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}
@stop
