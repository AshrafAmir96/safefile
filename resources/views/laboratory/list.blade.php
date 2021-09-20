@extends('layouts.admin-master')

@section('page-title', trans('app.laboratory_management'))
@section('page-heading', trans('app.laboratory_management'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.laboratory_management')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-3 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::has('search') ? Request::get('search') : '' }}"
                               placeholder="@lang('app.search_laboratory')">

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
                    {!! Form::select('regions', $regions, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    {!! Form::select('status', $statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('lab_type', $lab_types, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-2">
                    <a href="{{ route('content.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('app.add_laboratory')
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                   
                    <th class="min-width-150"> Laboratory Name</th>
                    <th class="min-width-100">Address</th>
                    <th class="min-width-80">Region</th>
                    <th class="min-width-80">Laboratory Type</th>
                    <th class="min-width-80">Contact</th>
                    <th class="min-width-80">@lang('app.status')</th>
                    <th class="min-width-80">Remarks</th>
                    <th class="min-width-80">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                         <tr>
                            <td> <a href="#">Lab 1</a></td>
                            <td> <a> Building 1 20-02,<br> Jalan Bangsar Baharu,<br> 59200 Kuala Lumpur, Malaysia</a></td>
                            <td> <a>Region 2</a></td>
                            <td> <a>High Power</a></td>
                            <td> <a>03-20405021</a></td>
                            <td> <a>Accredited to ISO</a></td>
                            <td> <a>Active</a></td>
                            
                            <td>
                                
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
