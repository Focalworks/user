@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>Users List</h2>
<hr/>

<div class="col-md-12" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

<table id="usertbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr.No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($users)
             <?php $index = 1; ?>
                @foreach ($users as $user)
                     <tr>
                        <td>{!! $index !!}</td>
                        <td>{!! $user->name !!}</td>
                        <td>{!! $user->email !!}</td>
                        <td>
                        @foreach ($user->user_roles()->get() as $user_role)
                            		<p> {!! $user_role->roles->role !!}</p>
                        @endforeach
                        </td>
                        <td>{!! date('d-m-Y H:i:s',strtotime($user->created_at)) !!}</td>
                        <td>{!! date('d-m-Y H:i:s',strtotime($user->updated_at)) !!}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>{!! HTML::link('admin/editUser/'.$user->id, 'Edit User', array('class' => 'btn btn-link')) !!}</li>
                                  <li>{!! HTML::link('admin/changeUserPassword/'.$user->id, 'Change Password', array('class' => 'btn btn-link')) !!}</li>
                                  <li>{!! HTML::link('admin/deleteUser/'.$user->id, 'Delete User', array('class' => 'btn btn-link')) !!}</li>
                                </ul>
                             </div>
                        </td>
                     </tr>
                       <?php $index++; ?>
                @endforeach
             @endif
        </tbody>
</table>
</div>
@endsection