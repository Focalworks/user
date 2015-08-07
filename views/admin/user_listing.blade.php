@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Users List</h2>
            <br/>

            @include('users::errors.error-block')

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
                                    @if(access_check('edit_user',true))
                                        <a href="{{ url('admin/editUser/'.$user->id)  }}" class="btn btn-link"
                                           title="Edit User"><span class="glyphicon glyphicon-pencil"></span></a>
                                    @endif
                                    @if(access_check('change_user_password',true))
                                        <a href="{{ url('admin/changeUserPassword/'.$user->id)  }}" class="btn btn-link"
                                           title="Change User Password"><span class="glyphicon glyphicon-cog"></span></a>
                                    @endif
                                    @if(access_check('delete_user',true))
                                        <a href="{{ url('admin/deleteUser/'.$user->id)  }}" class="btn btn-link"
                                       title="Delete User"
                                       onclick="return confirm('Do you really want to delete this user?')"><span
                                                class="glyphicon glyphicon-trash"></span></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <?php $index++; ?>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection