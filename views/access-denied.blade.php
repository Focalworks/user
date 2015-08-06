@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-7 col-md-push-2" role="main">
             <h2>Access Denied</h2>
                    <br/>
             @if(Auth::check())
             <div class="pull-right"><a href="{{ url('users/logout/') }}" class="btn btn-link" title="Edit User"><span class="glyphicon glyphicon-lock"></span> Logout</a></div>
             @endif
             <div class="alert alert-danger">
             You don't have access to this page...<a href="{{ url('users/login')  }}" class="btn btn-link">Go to Home Page</a>
             </div>
        </div>
    </div>
@endsection
