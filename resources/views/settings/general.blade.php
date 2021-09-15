@extends('layouts.admin-master')

@section('page-title', trans('app.general_settings'))
@section('page-heading', trans('app.general_settings'))

@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">
            <a href="{{ route('settings.general') }}">@lang('app.settings')</a>
        </div>
        <div class="breadcrumb-item active">
            @lang('app.general')
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'settings.general.update', 'id' => 'general-settings-form']) !!}

<!-- Nav tabs -->
<ul class="nav nav-pills mb-4 mt-2" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a href="#auth"
           class="nav-link active"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-file"></i>
            @lang('app.front_end')
        </a>
    </li>
    <li class="nav-item">
        <a href="#registration"
           class="nav-link"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-code"></i>
            @lang('app.back_end')
        </a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="auth">
        <div class="row">
            <div class="col-md-6">
                @include('settings.partials.front-end-general')
               
            </div>
            <div class="col-md-6">
                @include('settings.partials.front-end-navbar')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="registration">
        <div class="row">
            <div class="col-md-6">
                @include('settings.partials.back-end-general')
            </div>
            <div class="col-md-6">
                <!-- @include('settings.partials.recaptcha')
                @include('settings.partials.twilio') -->
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    @lang('app.update_settings')
</button>

{{ Form::close() }}
@stop