@extends('master.layout')

@section('title', '<h2>Login Page</h2>')

@section('content')
<div class="col-md-9" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

    {!! Form::open(array('url' => 'users/login','class' => 'form-horizontal')) !!}
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-6">
    {!! Form::email('username','',array('class' => 'form-control','placeholder' => 'Username')) !!}
     <p class="text-danger">{!! $errors->first('username') !!}</p>
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
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          {!! Form::checkbox('remember_me', 'yes') !!} Remember Me
        </label>
      </div>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      {!! Form::submit('Login',array('class' => 'btn btn-primary')) !!}
      {!! HTML::link('users/login', 'Cancel', array('class' => 'btn btn-default')) !!}
    </div>
  </div>
    
    {!! Form::close() !!}
{!! HTML::link('users/register', 'New User? Register Here!!', array('class' => 'btn btn-link')) !!} |  {!! HTML::link('users/login', 'Forgot Password?', array('class' => 'btn btn-link')) !!}
</div>
@endsection


