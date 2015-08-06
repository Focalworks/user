@if ($layout)
@extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Change User Password : {!! $user->name !!}</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('admin/saveUserPassword')  }}" method="POST" class="form-horizontal">
                 <input type="hidden" name="user_id" value="{{ $user->id }}">
                 @include('users::change-password-form',['submitButtonTxt'=> 'Save','redirectUrl'=> 'admin/userListing'])
            </form>
        </div>
    </div>
@endsection
