@extends('layouts.admin-master')

@section('page-title', trans('app.iventory_consumable'))
@section('page-heading', trans('app.iventory_consumable'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('user.list') }}">@lang('app.administration')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.iventory_consumable')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-5 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::has('search') ? Request::get('search') : '' }}"
                               placeholder="Search Inventory ...">

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

                <div class="col-md-3 mt-2 mt-md-0">
                    {!! Form::select('regions', $validation_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-2 mt-2 mt-md-0">
                    {!! Form::select('status', $approval_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

               

                <div class="col-md-2">
                    <a href="{{ route('content.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                       Add Inventory
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                   
                    <th class="min-width-150">Name</th>
                    <th class="min-width-100">Stock Type</th>
                    <th class="min-width-80">Date Received</th>
                    <th class="min-width-80">Quantity</th>
                    <th class="min-width-80">Remarks</th>
                    <th class="min-width-80">@lang('app.status')</th>
                    <th class="min-width-80">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($users))
                         <tr>
                            <td> <a href="#">Chemical 1</a></td>
                            <td> Chemical</td>
                            <td> 01/05/2021</td>
                            <td> 100</td>
                            <td> No Remarks</td>
                            <td> Confirmed</td>
                            
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
