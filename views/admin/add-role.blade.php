@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 well col-md-push-1" role="main">
            @include('users::menubar')

            <h2>Add Role</h2>
            <br/>

            @if(Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif

            <form action="{{ url('admin/saveRole')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="role" class="col-sm-2 control-label">Role</label>

                    <div class="col-sm-6">
                        <input type="text" name="role" class="form-control" placeholder="Enter Role" value="{{ Input::old('role') }}">

                        <p class="text-danger">{!! $errors->first('role') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/roleListing')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection