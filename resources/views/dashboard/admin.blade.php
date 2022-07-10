@extends('layouts.admin-master')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="m-4 fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>@lang('app.total_users')</h4>
                </div>
                <div class="card-body">
                    {{ number_format($stats['total']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="m-4 fas fa-user-plus"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>@lang('app.new_users_this_month')</h4>
                </div>
                <div class="card-body">
                    {{ number_format($stats['new']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="m-4 fas fa-user-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>@lang('app.unconfirmed_users')</h4>
                </div>
                <div class="card-body">
                    {{ number_format($stats['unconfirmed']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="m-4 fas fa-user-lock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>@lang('app.banned_users')</h4>
                </div>
                <div class="card-body">
                    {{ number_format($stats['banned']) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>@lang('app.registration_history')</h5>
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="myChart" height="365"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>@lang('app.latest_registrations')</h5>
            </div>
            <div class="card-body">
                @if (count($latestRegistrations))
                    <ul class="list-group list-group-flush">
                        @foreach ($latestRegistrations as $user)
                            <li class="list-group-item list-group-item-action">
                                <a href="{{ route('user.show', $user->id) }}" class="d-flex text-dark no-decoration">
                                    <img class="rounded-circle" width="40" height="40" src="{{ $user->present()->avatar }}">
                                    <div class="ml-2" style="line-height: 1.2;">
                                        <span class="d-block p-0">{{ $user->present()->nameOrEmail }}</span>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">@lang('app.no_records_found')</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>@lang('app.application_number') ({!! Carbon\Carbon::now()->format('Y') !!})</h5>
            </div>
            <div class="card-body">
                <div class="pt-4 px-3">
                    <canvas id="multi_graph" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 text-center">
                <h5>@lang('app.application_number_by_file')</h5>
           
                <div class="pt-4 px-3">
                    <canvas id="donut" height="220"></canvas>
                </div>
                <h5 class="mt-4">@lang('app.application_number_by_jofa')</h5>

                <div class="pt-4 px-3">
                    <canvas id="donut2" height="220"></canvas>
                </div>
    </div>
    </div>
</div>

@stop

@section('scripts')
    <script>
        var users = {!! json_encode(array_values($usersPerMonth)) !!};
        var months = {!! json_encode(array_keys($usersPerMonth)) !!};
        var trans = {
            chartLabel: "{{ trans('app.registration_history')  }}",
            new: "{{ trans('app.new_sm') }}",
            user: "{{ trans('app.user_sm') }}",
            users: "{{ trans('app.users_sm') }}"
        };

        var xValues = ["Documents", "Videos"];
        var yValues = [80,20];
        var barColors = [
        "#33cc33",
        "#80bfff"
        
        ];

        new Chart("donut", {
        type: "doughnut",
        data: {
         
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Type of Content"
            }
        }

        });

        new Chart("donut2", {
        type: "doughnut",
        data: {
         
            datasets: [{
            backgroundColor: barColors,
            data: [80,60]
            }]
        },
        options: {
            title: {
            display: false,
            text: "Type of Content"
            }
        }

        });



        var xValues = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

        new Chart("multi_graph", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            data: [70,72,90,100,80,90,88,92,96],
            borderColor: "#80bfff",
            fill: false
            }]
        },
        options: {
            legend: {display: false}
        }
        });

        var xValues3 = ["Johor", "Selangor", "Perlis", "Kedah", "Pahang"];
        var yValues3 = [55, 90, 80, 60, 120];
        var barColors3= ["#80bfff", "#80bfff","#80bfff","#80bfff","#80bfff"];

        new Chart("bar_graph", {
        type: "bar",
        data: {
            labels: xValues3,
            datasets: [{
            backgroundColor: barColors3,
            data: yValues3
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Customer by State"
            }
        }
        });

        var xValues4 = ["Malaysia", "Indonesia", "Thailand", "Philippines", "India","Brunei","Singapore","Japan","Germany","Australia"];
        var yValues4 = [55, 49, 44, 24, 42, 60, 51, 50, 52, 40];
        var barColors4= ["#80bfff", "#80bfff","#80bfff","#80bfff","#80bfff","#80bfff","#80bfff","#80bfff","#80bfff","#80bfff"];

        new Chart("bar_graph2", {
        type: "bar",
        data: {
            labels: xValues4,
            datasets: [{
            backgroundColor: barColors4,
            data: yValues4
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "Customer by Country"
            }
        }
        });
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}
    
@stop