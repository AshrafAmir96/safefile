@extends('layouts.admin-master')

@section('page-title', trans('app.registration'))
@section('page-heading', trans('app.registration'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.in_house')</div>
        <div class="breadcrumb-item">@lang('app.registration')</div>
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

                <div class="col-md-2">
                    <a href="{{ route('content.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('app.add_registration')
                    </a>
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
                    <th class="min-width-80">Laboratory</th>
                    <th class="min-width-80">Level</th>
                    <th class="min-width-80">Validation @lang('app.status')</th>
                    <th class="min-width-80">Approval @lang('app.status')</th>
                    <th class="min-width-150">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                         <tr>
                            <td> 1</td> 
                            <td> <a href="#">TEST-200302-21-3111</a></td>
                            <td> High Power</td>
                            <td> <a href="#">Lab 1</a></td>
                            <td> Allocate Sample</td>
                            <td> Pending</td>
                            <td> Pending</td>
                            
                            <td>
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Allocate Sample"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-exchange-alt"></i>
                                </a>
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Result Entry"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-poll-h"></i>
                                </a>
                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Edit"
                                data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href=""
                                style="padding: 2px;" class="text-dark"
                                title="Delete"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="@lang('app.please_confirm')"
                                data-confirm-text="Are you sure want to delete?"
                                data-confirm-delete="Delete">
                                    <i class="fas fa-trash"></i>
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
