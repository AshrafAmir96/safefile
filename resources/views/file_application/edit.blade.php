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
        <div class="breadcrumb-item">
            @lang('app.edit')
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
            {!! Form::open([
                'route' => ['file_application.update', $file_application->id],
                'method' => 'PUT',
                'id' => 'file-application-form',
            ]) !!}
            <div class="card">
                <div class="card-body">
                    <div class="float-right2">
                        <span class="badge badge-lg badge-{{ $color_statuses[$file_application->status] }}">
                            {!! $statuses[$file_application->status] !!}
                        </span></div>
                    <div class="form-group">
                        <label for="app_num">@lang('app.app_num')</label>
                        <div class="h6 font-weight-bold my-2">{!! $file_application->ref_num !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="file_type">@lang('app.file_type')</label>
                                {!! Form::select('file_type', $file_types, $file_application->file_type, [
                                    'id' => 'file_type',
                                    'class' => 'form-control input-solid',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="jofa_type">@lang('app.jofa_type')</label>
                                {!! Form::select('jofa_type', $jofa_types, $file_application->jofa_type, [
                                    'id' => 'jofa_type',
                                    'class' => 'form-control input-solid',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file_num">@lang('app.file_num')</label>
                        <input class="form-control" type="text" name="file_num" id="file_num"
                            value="{!! $file_application->file_num !!}" placeholder="@lang('app.placeholder_file_num')" />
                    </div>
                    <div class="form-group">
                        <label for="other_ref">@lang('app.other_ref')</label>
                        <input class="form-control" type="text" name="other_ref" id="other_ref"
                            value="{!! $file_application->other_ref !!}" placeholder="@lang('app.placeholder_other_ref')" />
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="float-lelft">
                    <button class="btn btn-danger" name="action" value="delete">@lang('app.delete')</button>
                </div>
                <div class="float-right">
                    <button class="btn btn-success" name="action" value="save">@lang('app.save')</button>
                    <button class="btn btn-primary" name="action" value="send">@lang('app.send')</button>
                </div>
            </div>
            {!! Form::close() !!}
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
