@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>All Roles</h2>

            @if(access_check('add_role',true)) <div class="pull-right"><a href="{{ url('admin/addRole/') }}" class="btn btn-link" title="Edit User"><span class="glyphicon glyphicon-plus"></span> Add New Role</a></div> @endif
            @include('users::errors.error-block')

            <table id="roletbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($roles)
                    <?php $index = 1; ?>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{!! $index !!}</td>
                                <td>{!! $role->role !!}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(access_check('edit_role',true))
                                            <a href="{{ url('admin/editRole/'.$role->rid) }}" class="btn btn-link" title="Edit Role"><span class="glyphicon glyphicon-pencil"></span></a>
                                        @endif
                                        @if(access_check('delete_role',true))
                                            @if ($role->rid != 1 && $role->rid != 2)
                                                <a href="{{ url('admin/deleteRole/'.$role->rid) }}" class="btn btn-link" title="Delete Role" onclick="return confirm('Do you really want to delete this role?')"><span class="glyphicon glyphicon-trash"></span></a>
                                            @endif
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