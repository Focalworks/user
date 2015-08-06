<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>

    <div class="col-sm-6">
        <input type="password" name="password" class="form-control" placeholder="New Password" value="">

        <p class="text-danger">{!! $errors->first('password') !!}</p>
    </div>
</div>
<div class="form-group">
    <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>

    <div class="col-sm-6">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
               value="">

        <p class="text-danger">{!! $errors->first('password_confirmation') !!}</p>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary">{{ $submitButtonTxt }}</button>
        <a href="{{ url($redirectUrl)  }}" class="btn btn-link">Cancel</a>
    </div>
</div>