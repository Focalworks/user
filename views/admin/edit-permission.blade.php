@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Edit: {{ $permission->name }}</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('admin/editPermission/')  }}" method="POST" class="form-horizontal">
                <input type="hidden" name="pid" value="{{ $permission->pid }}">
                @include('users::admin.permission-form',['submitButtonTxt'=> 'Update','permission_data' => $permission])
            </form>
        </div>
    </div>
@endsection