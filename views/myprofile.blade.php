@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>Welcome {!! strtoupper($user->name) !!}</h2>
<hr/>

<div class="col-md-9" role="main">
<div class="clearfix"></div>
@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

<table class="table table-bordered">
 	<tr>
 		<th>Display Name</th>
 		<td>{!! $user->name !!}</td>
 	</tr>
 	<tr>
 		<th>Email</th>
 		<td>{!! $user->email !!}</td>
 	</tr>
 	<tr>
 		<th>Roles</th>
 		<td>
 		@foreach ($user_roles as $user_role)
    		<p> {!! $user_role->roles->role !!}</p>
		@endforeach
		</td>
 	</tr>
</table>
@endsection
