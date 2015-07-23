@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>Edit Profile</h2>
<hr/>

<div class="col-md-9" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

    {!! Form::open(array('url' => 'users/saveUserProfile','class' => 'form-horizontal')) !!}

    <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Display Name</label>
    <div class="col-sm-6">
    {!! Form::text('name',$user->name,array('class' => 'form-control','placeholder' => 'Display Name')) !!}
    <p class="text-danger">{!! $errors->first('name') !!}</p>
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


