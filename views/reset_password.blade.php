@if ($layout)
@extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">

            <h2>Reset Password : {!! $user->name !!}</h2>
            <br/>

            @include('users::errors.error-block')

            <form action="{{ url('users/resetPassword')  }}" method="POST" class="form-horizontal">
                 <input type="hidden" name="user_id" value="{{ $user->id }}">
                  @include('users::change-password-form',['submitButtonTxt'=> 'Reset','redirectUrl'=> 'users/login'])
            </form>
        </div>
    </div>
@endsection
