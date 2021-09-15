<div class="card">
    <div class="card-body">

        <h5 class="card-title">
            @lang('app.navbar')
        </h5>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                 <label for="switch-fixed-position" class="control-label">
                     <input type="hidden" value="0" name="fixed_position">
                     {!! Form::checkbox('fixed_position', 1, setting('fixed_position'), ['class' => 'custom-switch-input', 'id' => 'switch-fixed-position']) !!}
                     <span class="custom-switch-indicator"></span>
                 </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('app.fixed_position')</label>
                    <small class="pt-0 text-muted">
                        @lang('app.fixed_position_description')
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <label for="menu_color_input">
                @lang('app.menu_color') <br>
                <small class="text-muted">@lang('app.menu_color_description')</small>
            </label>
            {!! Form::select('size', array('bg-dark' => 'Dark', 'bg-danger' => 'Red', '' => 'White', 'bg-primary' => 'Purple', 'bg-info' => 'Blue'), setting('menu_color'),['id' => 'menu_color','name' => 'menu_color', 'class' => 'form-control input-solid'])!!}
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                 <label for="switch-fixed-position" class="control-label">
                     <input type="hidden" value="0" name="allow_login_navbar">
                     {!! Form::checkbox('fixed_position', 1, setting('allow_login_navbar'), ['class' => 'custom-switch-input', 'id' => 'switch-fixed-position']) !!}
                     <span class="custom-switch-indicator"></span>
                 </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('app.allow_login_button')</label>
                    <small class="pt-0 text-muted">
                        @lang('app.allow_login_button_description')
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="d-flex align-items-center">
                 <label for="switch-fixed-position" class="control-label">
                     <input type="hidden" value="0" name="allow_search_navbar">
                     {!! Form::checkbox('fixed_position', 1, setting('allow_search_navbar'), ['class' => 'custom-switch-input', 'id' => 'switch-fixed-position']) !!}
                     <span class="custom-switch-indicator"></span>
                 </label>
                <div class="ml-3 d-flex flex-column">
                    <label class="mb-0">@lang('app.allow_search_form')</label>
                    <small class="pt-0 text-muted">
                        @lang('app.allow_search_form_description')
                    </small>
                </div>
            </div>
        </div>
     
    </div>
</div>