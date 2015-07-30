@if ($layout)
@extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 well col-md-push-1" role="main">

            <h2>Reset Password : {!! $user->name !!}</h2>
            <br/>

            @if(Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif

            <form action="{{ url('users/resetPassword')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="user_id" value="{{ $user->id }}">

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
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" value="">

                        <p class="text-danger">{!! $errors->first('password_confirmation') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ url('users/login')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection