@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>All Roles</h2>
<hr/>

<div class="col-md-12" role="main">
<div class="pull-right">{!! HTML::link('admin/addRole', 'Add New Role', array('class' => 'btn btn-link')) !!}</div>
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
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>{!! HTML::link('admin/editRole/'.$role->rid, 'Edit Role', array('class' => 'btn btn-link')) !!}</li>
                                  @if ($role->rid != 1)
                                  <li>{!! HTML::link('admin/deleteRole/'.$role->rid, 'Delete Role', array('class' => 'btn btn-link')) !!}</li>
                                  @endif
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