@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-7 well col-md-push-2" role="main">
         <h2>Login</h2>
                <br/>
            @if(Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif

            <form action="{{ url('users/login')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" value="{{ Input::old('username') }}">

                        <p class="text-danger">{!! $errors->first('username') !!}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-6">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password">

                        <p class="text-danger">{!! $errors->first('password') !!}</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" checked> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>

            <a href="{{ url('users/register')  }}" class="btn btn-link">New User? Register Here!!</a>
            <a href="{{ url('users/forgotPassword')  }}" class="btn btn-link">Forgot Password?</a>
        </div>
    </div>
@endsection


