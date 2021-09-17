@extends('layouts.admin-master')

@section('page-title', trans('app.waste-supplier'))
@section('page-heading', trans('app.waste-supplier'))

@section('breadcrumbs')
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">
        <a href="{{ route('user.list') }}">@lang('app.administration')</a>
    </div>
    <div class="breadcrumb-item">@lang('app.waste-supplier')</div>
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
                        <input type="text" class="form-control input-solid" name="search" value="" placeholder="Search for supplier">

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

                <div class="col-md-8">
                    <a href="" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        Add supplier record
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Supplier Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>@lang('app.action')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Supplier #1</td>
                        <td>012-3456 7891</td>
                        <td>supplier.1@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete record</button>
                            <button type="button" class="btn btn-primary">View all activity conducted</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Supplier #2</td>
                        <td>012-3456 7891</td>
                        <td>supplier.2@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete record</button>
                            <button type="button" class="btn btn-primary">View all activity conducted</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Supplier #3</td>
                        <td>012-3456 7891</td>
                        <td>supplier.3@example.com</td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete record</button>
                            <button type="button" class="btn btn-primary">View all activity conducted</button>
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