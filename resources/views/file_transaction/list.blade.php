@extends('layouts.admin-master')

@section('page-title', trans('app.file_transaction_list'))
@section('page-heading', trans('app.file_transaction_list'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('file_transaction.index') }}">@lang('app.management')</a>
        </div>
        <div class="breadcrumb-item">@lang('app.file_transaction_list')</div>
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
                               placeholder="@lang('app.search_for_transaction')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('file_transaction.index') }}"
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
                    {!! Form::select('status', $transaction_statuses, Request::get('status'), ['id' => 'status', 'class' => 'form-control input-solid']) !!}
                </div>

                <div class="col-md-5">
                   
                </div>
            </div>
        </form>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-borderless table-striped">
                <thead>
                <tr>
                    <th class="min-width-100">@lang('app.id')</th>
                    <th class="min-width-100">@lang('app.rfid')</th>
                    <th class="min-width-100">@lang('app.app_num')</th>
                    <th class="min-width-80">@lang('app.trx_type')</th>
                    <th class="min-width-80">@lang('app.created_at')</th>
                </tr>
                </thead>
                <tbody>
                    @if (count($file_transactions))
                        @foreach ($file_transactions as $file_transaction)
                            @include('file_transaction.partials.row')
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

{!! $file_transactions->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#file-application-search-form").submit();
        });
    </script>
@stop
