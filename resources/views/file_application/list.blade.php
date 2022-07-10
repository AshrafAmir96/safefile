@extends('layouts.admin-master')

@section('page-title', trans('app.file_application_list'))
@section('page-heading', trans('app.file_application_list'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('file_application.index') }}">@lang('app.management')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.file_application_list')</div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card">
    <div class="card-body">

        <form action="" method="GET" id="file-application-search-form" class="pb-2 mb-3 border-bottom-light">
            <div class="row my-3 flex-md-row flex-column-reverse">
                <div class="col-md-4 mt-md-0 mt-2">
                    <div class="input-group custom-search-form">
                        <input type="text"
                               class="form-control input-solid"
                               name="search"
                               value="{{ Request::has('search') ? Request::get('search') : '' }}"
                               placeholder="@lang('app.search_for_application')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('file_application.index') }}"
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
                    {!! Form::select('status', $statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-6">
                    <a href="{{ route('file_application.create') }}" class="btn btn-primary btn-rounded float-right">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('app.create_file_application')
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-150">@lang('app.app_num')</th>
                    <th class="min-width-100">@lang('app.file_num')</th>
                    <th class="min-width-100">@lang('app.file_type')</th>
                    <th class="min-width-80">@lang('app.created_at')</th>
                    <th class="min-width-80">@lang('app.received_at')</th>
                    <th class="min-width-80">@lang('app.status')</th>
                    <th class="text-center min-width-80">@lang('app.action')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($file_applications))
                        @foreach ($file_applications as $file_application)
                            @include('file_application.partials.row')
                        @endforeach
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

{!! $file_applications->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#file-application-search-form").submit();
        });
    </script>
@stop
