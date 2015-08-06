@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Edit Role : {!! $role->role !!}</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('admin/saveRole')  }}" method="POST" class="form-horizontal">
                 <input type="hidden" name="rid" value="{{ $role->rid }}">
                 @include('users::admin.role-form',['submitButtonTxt'=> 'Update','role' => $role])
            </form>
        </div>
    </div>
@endsection