@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>Change Password</h2>
<hr/>

<div class="col-md-9" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

    {!! Form::open(array('url' => 'users/saveNewPassword','class' => 'form-horizontal')) !!}
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Current Password</label>
    <div class="col-sm-6">
      {!! Form::password('current_password',array('class' => 'form-control','placeholder' => 'Current Password')) !!}
     <p class="text-danger">{!! $errors->first('current_password') !!}</p>
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
      {!! Form::submit('Save',array('class' => 'btn btn-primary')) !!}
      {!! HTML::link('users/myprofile', 'Cancel', array('class' => 'btn btn-default')) !!}
    </div>
  </div>
    
    {!! Form::close() !!}
    
</div>
@endsection