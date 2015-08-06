@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Add Permission</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('admin/addPermission')  }}" method="POST" class="form-horizontal">
                @include('users::admin.permission-form',['submitButtonTxt'=> 'Add'])
            </form>
        </div>
    </div>
@endsection