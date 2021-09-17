@extends('layouts.admin-master')

@section('page-title', trans('app.outside_services_sampling'))
@section('page-heading', trans('app.outside_services_sampling'))

@section('breadcrumbs')
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{ route('user.list') }}">@lang('app.administration')</a>
    </div>
    <div class="breadcrumb-item">@lang('app.outside_services_sampling')</div>
</div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control input-solid" name="search" value="" placeholder="Search for sampling...">

                        <span class="input-group-append">
                            @if (Request::has('search') && Request::get('search') != '')
                            <a href="{{ route('user.list') }}" class="btn btn-light d-flex align-items-center text-muted" role="button">
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
                    <select class="form-control input-solid" aria-label="Default select example">
                        <option selected>Sort By Status</option>
                        <option>Completed</option>
                        <option>Upcoming</option>
                        <option>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2 mt-2 mt-md-0">
                    <select class="form-control input-solid" aria-label="Default select example">
                        <option selected>Sort By Newest</option>
                        <option>Sort By Oldest</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <a href="" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        Scheduled a sampling
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <p>Assign technician to the sampling job by clicking the pencil icon and reschedule scheduled date by clicking the calendar icon. View the technician profile by clicking the technician name.</p>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Issued date</th>
                        <th>Scheduled date</th>
                        <th>Technician In-Charge</th>
                        <th>@lang('app.status')</th>
                        <th>@lang('app.action')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>21/08/2021</td>
                        <td>01/09/2021</td>
                        <td><a href="">Technician #1</a></td>
                        <td>Completed</td>
                        <td>
                            <a
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Edit"
                                data-toggle="tooltip" data-placement="top"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a 
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Delete"
                                data-toggle="tooltip"
                                data-placement="top"
                                
                                data-confirm-title="@lang('app.please_confirm')"
                                data-confirm-text="Are you sure want to delete?"
                                data-confirm-delete="Delete"
                            >
                                <i class="fas fa-calendar"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>02/09/2021</td>
                        <td>16/09/2021</td>
                        <td><a href="">Technician #2</a></td>
                        <td>Upcoming</td>
                        <td>
                            <a
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Edit"
                                data-toggle="tooltip" data-placement="top"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a 
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Delete"
                                data-toggle="tooltip"
                                data-placement="top"
                                
                                data-confirm-title="@lang('app.please_confirm')"
                                data-confirm-text="Are you sure want to delete?"
                                data-confirm-delete="Delete"
                            >
                                <i class="fas fa-calendar"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>29/08/2021</td>
                        <td>01/09/2021</td>
                        <td><a href="">Technician #1</a></td>
                        <td>Cancelled</td>
                        <td>
                            <a
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Edit"
                                data-toggle="tooltip" data-placement="top"
                            >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a 
                                href=""
                                style="padding: 2px;" class="text-dark"
                                title="Delete"
                                data-toggle="tooltip"
                                data-placement="top"
                                
                                data-confirm-title="@lang('app.please_confirm')"
                                data-confirm-text="Are you sure want to delete?"
                                data-confirm-delete="Delete"
                            >
                                <i class="fas fa-calendar"></i>
                            </a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

{!! $users->render() !!}

@stop

@section('scripts')
<script>
    $("#status").change(function() {
        $("#users-form").submit();
    });
</script>
@stop