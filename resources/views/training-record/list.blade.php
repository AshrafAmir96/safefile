@extends('layouts.admin-master')

@section('page-title', trans('app.training_record'))
@section('page-heading', trans('app.training_record'))

@section('breadcrumbs')
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{ route('user.list') }}">@lang('app.administration')</a>
    </div>
    <div class="breadcrumb-item">@lang('app.training_record')</div>
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
                        <input type="text" class="form-control input-solid" name="search" value="" placeholder="Search for training by name">

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
                        Scheduled a training
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Training Name</th>
                        <th>Duration</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Supplier</th>
                        <th>@lang('app.status')</th>
                        <th>@lang('app.action')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Training #1</td>
                        <td>5 days</td>
                        <td>20/09/2021</td>
                        <td>24/09/2021</td>
                        <td><a href="">Supplier #1</a></td>
                        <td>Completed</td>
                        <td>
                            <button type="button" class="btn btn-primary">View staff involved</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Training #2</td>
                        <td>5 days</td>
                        <td>20/09/2021</td>
                        <td>24/09/2021</td>
                        <td><a href="">Supplier #2</a></td>
                        <td>Upcoming</td>
                        <td>
                            <button type="button" class="btn btn-primary">Send staff for training</button>
                            <button type="button" class="btn btn-danger">Cancel training</button>
                        </td>
                    </tr>
                     <tr>
                        <td>3</td>
                        <td>Training #3</td>
                        <td>5 days</td>
                        <td>20/09/2021</td>
                        <td>24/09/2021</td>
                        <td><a href="">Supplier #2</a></td>
                        <td>Cancelled</td>
                        <td>
                            <button type="button" class="btn btn-primary">View staff involved</button>
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