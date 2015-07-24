@if ($layout)
    @extends($layout)
@endif

@section('content')

<h2>Registration Page</h2>
<hr/>

<div class="col-md-9" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

    {!! Form::open(array('url' => 'users/register','class' => 'form-horizontal')) !!}

    <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Display Name</label>
    <div class="col-sm-6">
    {!! Form::text('name','',array('class' => 'form-control','placeholder' => 'Display Name')) !!}
    <p class="text-danger">{!! $errors->first('name') !!}</p>
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-6">
    {!! Form::email('email','',array('class' => 'form-control','placeholder' => 'Email')) !!}
     <p class="text-danger">{!! $errors->first('email') !!}</p>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-6">
    {!! Form::password('password',array('class' => 'form-control','placeholder' => 'Password')) !!}
    <p class="text-danger">{!! $errors->first('password') !!}</p>
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Confirm Password</label>
    <div class="col-sm-6">
    {!! Form::password('password_confirmation',array('class' => 'form-control','placeholder' => 'Confirm Password')) !!}
     <p class="text-danger">{!! $errors->first('password_confirmation') !!}</p>
    </div>
  </div>

    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Register',array('class' => 'btn btn-primary')) !!}
      {!! HTML::link('users/login', 'Cancel', array('class' => 'btn btn-default')) !!}
    </div>
  </div>
    
    {!! Form::close() !!}
    
</div>
@endsection


