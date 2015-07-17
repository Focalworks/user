@extends('master.layout')

@section('title', '<h2>Welcome '.$user->name.'</h2>')

@section('content')
<div class="col-md-9" role="main">
<div class="pull-right">{!! HTML::link('users/logout', 'Logout', array('class' => 'btn btn-link')) !!}</div>

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
</table>
@endsection
