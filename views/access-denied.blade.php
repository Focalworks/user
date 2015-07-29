@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-7 well col-md-push-2" role="main">
             <h2>Access Denied</h2>
                    <br/>
             <div class="alert alert-danger">
             You don't have accecc to this page...<a href="{{ url('users/login')  }}" class="btn btn-link">Go to Home Page</a>
             </div>
        </div>
    </div>
@endsection
