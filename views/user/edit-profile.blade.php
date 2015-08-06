@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Edit Profile</h2>
            <hr/>

            @include('users::errors.error-block')

            <form action="{{ url('users/saveUserProfile')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Display Name</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ isset($user->name) ? $user->name : Input::old('name') }}">

                        <p class="text-danger">{!! $errors->first('name') !!}</p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ url('users/myprofile')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


