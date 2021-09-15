<div class="card">
    <div class="card-body">

        <h5 class="card-title">
            @lang('app.general')
        </h5>

        <div class="form-group my-4">
            <label for="login_reset_token_lifetime">
                @lang('app.name') <br>
                <small class="text-muted">@lang('app.name')</small>
            </label>
            <input type="text" name="app_name" id="app_name"
                   class="form-control" value="{{ setting('app_name') }}">
        </div>
    
    </div>
</div>