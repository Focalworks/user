@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Add Role</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('admin/saveRole')  }}" method="POST" class="form-horizontal">
            @include('users::admin.role-form',['submitButtonTxt'=> 'Add'])
            </form>
        </div>
    </div>
@endsection