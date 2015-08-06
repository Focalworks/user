@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-9 col-md-push-2" role="main">
        <h2>User Registration</h2>
        <br/>
            @include('users::errors.error-block')

            <form action="{{ url('users/register')  }}" method="POST" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Display Name</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Enter your display name" value="{{ Input::old('name') }}">

                        <p class="text-danger">{!! $errors->first('name') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-6">
                        <input type="text" name="email" class="form-control" placeholder="Enter your email" value="{{ Input::old('email') }}">

                        <p class="text-danger">{!! $errors->first('email') !!}</p>
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
                    <label for="password" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-6">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password">

                        <p class="text-danger">{!! $errors->first('password_confirmation') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Register</button>
                        <a href="{{ url('users/login')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

