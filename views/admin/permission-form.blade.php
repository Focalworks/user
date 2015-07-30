<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="role" class="col-sm-2 control-label">Action</label>

    <div class="col-sm-6">
        <input type="text" name="name" class="form-control" placeholder="Enter Action" value="{{ isset($permission_data) ? $permission_data->name : Input::old('name') }}">

        <p class="text-danger">{!! $errors->first('name') !!}</p>
    </div>
</div>

<div class="form-group">
    <label for="role" class="col-sm-2 control-label">Display name</label>
    <div class="col-sm-6">
        <input type="text" name="display_name" class="form-control" placeholder="Enter Display name" value="{{ isset($permission_data) ? $permission_data->display_name : Input::old('display_name') }}">

        <p class="text-danger">{!! $errors->first('display_name') !!}</p>
    </div>
</div>
<div class="form-group">
    <label for="role" class="col-sm-2 control-label">Group</label>
    <div class="col-sm-6">
        <input type="text" name="group" class="form-control" placeholder="Enter Group" value="{{ isset($permission_data) ? $permission_data->group : Input::old('group') }}">

        <p class="text-danger">{!! $errors->first('group') !!}</p>
    </div>
</div>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary">{{ $submitButtonTxt }}</button>
        <a href="{{ url('admin/permissionsListing')  }}" class="btn btn-link">Cancel</a>
    </div>
</div>