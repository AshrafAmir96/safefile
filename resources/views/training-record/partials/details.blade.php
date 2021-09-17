<div class="row">
    <div class="col-md-6">
        
      
        <div class="form-group">
            <label for="first_name">Content Name</label>
            <input type="text" class="form-control" id="first_name"
                   name="first_name" placeholder="Content Name" value="{{ $edit ? $user->first_name : '' }}">
        </div>
        <div class="form-group">
            <label for="last_name">Description</label>
            <input type="text" class="form-control" id="last_name"
                   name="last_name" placeholder="@lang('app.last_name')" value="{{ $edit ? $user->last_name : '' }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="birthday">Date</label>
            <div class="form-group">
                <input type="text"
                       name="birthday"
                       id='birthday'
                       value="09/09/2020"
                       class="form-control" 
                       readonly/>
            </div>
        </div>
        
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('app.update_details')
            </button>
        </div>
    @endif
</div>
