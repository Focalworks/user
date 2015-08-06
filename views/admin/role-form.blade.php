<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
    <label for="role" class="col-sm-2 control-label">Role</label>

    <div class="col-sm-6">
        <input type="text" name="role" class="form-control" placeholder="Enter Role" value="{{ isset($role) ? $role->role : Input::old('role') }}">

        <p class="text-danger">{!! $errors->first('role') !!}</p>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary">{{ $submitButtonTxt }}</button>
        <a href="{{ url('admin/roleListing')  }}" class="btn btn-link">Cancel</a>
    </div>
</div>