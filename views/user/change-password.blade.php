@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Change Password</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('users/saveNewPassword')  }}" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label for="current_password" class="col-sm-2 control-label">Current Password</label>

                    <div class="col-sm-6">
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password" value="">

                        <p class="text-danger">{!! $errors->first('current_password') !!}</p>
                    </div>
                </div>

                @include('users::change-password-form',['submitButtonTxt'=> 'Change Password','redirectUrl'=> 'users/myprofile'])
            </form>
        </div>
    </div>
@endsection
