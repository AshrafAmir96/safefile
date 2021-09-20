@extends('layouts.admin-master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@section('page-title', trans('app.data_analysis'))
@section('page-heading', trans('app.data_analysis'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
    
        <div class="breadcrumb-item">@lang('app.data_analysis')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
            
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    Data Trending By Year
                </div>
                <div class="card-body">
                    <div class="pt-4 px-3">
                        <canvas id="multi_graph2" height="200"></canvas>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                <div class="card-header">
                    Data Trending By Month
                </div>
                <div class="card-body">
                    <div class="pt-4 px-3">
                        <canvas id="multi_graph" height="200"></canvas>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                  
                    <div class="card-body">
                        <div class="pt-4 px-3">
                            <canvas id="donut2" height="200"></canvas>
                        </div>
                    </div>
                </div>
              
            </div>

        </form>
       

        
        
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


        var xValues2 = ["Trend 1", "Trend 2","Trend 3"];
        var yValues2 = [10,10,100];
        var barColors2 = [
        "#80bfff",
        "#cc99ff",
        "#0066cc"
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
            text: "Type Trending"
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


        var xValues = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

        new Chart("multi_graph", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            data: [40,0,12,4,10,41,100,0,19],
            borderColor: "#80bfff",
            fill: false
            },{
            data: [0,0,59,1,120,10,3,0,0],
            borderColor: "#cc99ff",
            fill: false
            },{
            data: [20,20,30,40,80,100,122,142,200],
            borderColor: "#0066cc",
            fill: false
            }]
        },
        options: {
            legend: {display: false}
        }
        });

        var xValues2 = ["2010","2011","2012","2013","2014","2015","2016","2017","2018","2019","2020","2021"];

        new Chart("multi_graph2", {
        type: "line",
        data: {
            labels: xValues2,
            datasets: [{
            data: [400,0,102,4,100,401,100,0,109],
            borderColor: "#80bfff",
            fill: false
            },{
            data: [0,0,590,1,1200,10,30,0,0],
            borderColor: "#cc99ff",
            fill: false
            },{
            data: [20,20,3000,4000,80,100,122,1420,2000],
            borderColor: "#0066cc",
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
