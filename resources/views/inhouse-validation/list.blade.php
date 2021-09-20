@extends('layouts.admin-master')

@section('page-title', trans('app.validation'))
@section('page-heading', trans('app.validation'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.in_house')</div>
        <div class="breadcrumb-item">@lang('app.validation')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-2 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::has('search') ? Request::get('search') : '' }}"
                               placeholder="@lang('app.search_registration')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('laboratory.list') }}"
                                           class="btn btn-light d-flex align-items-center text-muted"
                                           role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-users-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                    </div>
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    {!! Form::select('test_type', $test_types, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('status', $validation_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('lab_type', $approval_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

               
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-20">Index</th>
                    <th class="min-width-100">Ref Number</th>
                    <th class="min-width-80">Test Type</th>
                    <th class="min-width-80">Allocation Type</th>
                    <th class="min-width-200">Result</th>
                    <th class="min-width-200">PIC</th>
                    <th class="min-width-80">Validation @lang('app.status')</th>
                    <th class="min-width-150">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                         <tr>
                            <td> 1</td> 
                            <td> <a href="#">TEST-200302-21-3111</a></td>
                            <td> High Power</td>
                            <td> Normal</td>
                            <td> <strong>Attached Files:</strong> <br>Data 1 = 20% <br> Data 2 = 40% <br> Data 3 = 15% <br><br>
                                <strong>Attached Files:</strong><br>
                                 <a href=""> Result 1.xls</a><br>
                                 <a href=""> Image 1.png</a><br>
                                 <a href=""> Image 2.png</a><br>
                                </td>
                            <th class="min-width-200"><a href="">Staff 1</a></th>
                            <td> Pending</td>
                            <td>
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Accept"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Reject"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-times-circle"></i>
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
</div>

{!! $users->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#users-form").submit();
        });
    </script>
@stop
