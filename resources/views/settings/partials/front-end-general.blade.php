<div class="card">
    <div class="card-body">

        <h5 class="card-title">
            @lang('app.general')
        </h5>

        <div class="form-group my-4">
            <label for="login_reset_token_lifetime">
                @lang('app.homepage_name') <br>
                <small class="text-muted">@lang('app.homepage_name_description')</small>
            </label>
            <input type="text" name="homepage_name" id="homepage_name"
                   class="form-control" value="{{ setting('homepage_name') }}">
        </div>

        <div class="form-group my-4">
            <label for="login_reset_token_lifetime">
                @lang('app.homepage_description') <br>
                <small class="text-muted">@lang('app.homepage_description_description')</small>
            </label>
            <textarea name="homepage_description" id="homepage_description"
                   class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 193px;">{{ setting('homepage_description') }}</textarea>
        </div>
    
    </div>
</div>