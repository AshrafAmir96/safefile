@extends('layouts.admin-master')

@section('page-title', trans('app.file_application'))
@section('page-heading', trans('app.file_application'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            @lang('app.file_application')
        </div>
        <div class="breadcrumb-item active">
            {!! $file_application->ref_num !!}
        </div>
 
    </div>
@stop

@section('content')

    @include('partials.messages')

    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            <div class="my-2">
                <a class="btn btn-link" href="{{ route('file_application.index') }}">@lang('app.return_file_application_list')</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <span class="badge badge-lg badge-{{ $color_statuses[$file_application->status] }}">
                            {!! $statuses[$file_application->status] !!}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="app_num">@lang('app.app_num')</label>
                        <div class="my-2 h6 font-weight-bold">{!! $file_application->ref_num !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="file_type">@lang('app.file_type')</label>
                        <div class="my-2 h6 font-weight-bold">{!! $file_application->file_type ? $file_types[$file_application->file_type] : null !!}</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jofa_type">@lang('app.jofa_type')</label>
                        <div class="my-2 h6 font-weight-bold">{!! $file_application->jofa_type ? $jofa_types[$file_application->jofa_type] : null !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file_num">@lang('app.file_num')</label>
                        <div class="my-2 h6 font-weight-bold">{!! $file_application->file_num !!}</div>
                    </div>
                    <div class="form-group">
                        <label for="other_ref">@lang('app.other_ref')</label>
                        <div class="my-2 h6 font-weight-bold">{!! $file_application->other_ref !!}</div>
                    </div>
                    <div class="form-group">
                        <label for="other_ref">@lang('app.received_at')</label>
                        <div class="my-2 h6 font-weight-bold">{!!$file_application->received_at ? $file_application->received_at->format(config('app.date_time_format')) : '' !!}</div>
                    </div>
                    <div class="form-group">
                        <label for="rack_num">@lang('app.rack_num')</label>
                        <div class="my-2 h6 font-weight-bold">{!!$file_application->rack_num !!}</div>
                    </div>
                </div>
            </div>
            <div class="float-right">
                @if ($file_application->status == 2)
                <a class="btn btn-primary"
                    href="{{ route('file_application.approve', $file_application->id) }}">@lang('app.application_approval')</a>
                @endif
                @if ($file_application->status == 1)
                    <a class="btn btn-primary"
                        href="{{ route('file_application.edit', $file_application->id) }}">@lang('app.edit_application')</a>
                @endif
            </div>
        </div>


    </div>

@stop

@section('scripts')
    <script>
        file_type = $('#file_type').val();

        if (file_type == 2) {
            $("#jofa_type").prop("disabled", false);
        } else {
            $("#jofa_type").val('');
            $("#jofa_type").prop("disabled", true);
        }

        $('select[name="file_type"]').change(function() {

            if ($(this).val() == 2) {
                $("#jofa_type").prop("disabled", false);
            } else {
                $("#jofa_type").val('');
                $("#jofa_type").prop("disabled", true);
            }

        });
    </script>

    {!! JsValidator::formRequest('App\Http\Requests\FileApplicationUpdateRequest', '#file-application-form') !!}
@stop
