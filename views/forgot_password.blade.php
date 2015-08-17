@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-push-2 well" role="main">
         <h2>Forgot Password</h2>
                <br/>
                <p>We will email you instructions on how to reset your password.</p>

            @include('users::errors.error-block')

            <form action="{{ url('users/forgotPassword')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username/Email</label>

                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" placeholder="Enter your email" value="{{ Input::old('username') }}">

                        <p class="text-danger">{!! $errors->first('username') !!}</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ url('users/login')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection