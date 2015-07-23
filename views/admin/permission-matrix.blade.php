@if ($layout)
    @extends($layout)
@endif

@section('content')

@include('users::menubar')

<h2>Permission Matrix</h2>
<hr/>
<div class="col-md-12" role="main">

@if(Session::has('error'))
    <div class="alert alert-danger">{!! Session::get('error') !!}</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">{!! Session::get('success') !!}</div>
@endif

@if ($permission_matrix)
{!! Form::open(array('url' => 'admin/permissionMatrix','class' => 'form-horizontal')) !!}
   <table id="pmtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                   <th>Permission Name</th>
                   @if ($all_roles)
                    @foreach($all_roles as $role)
                    <th>{!! strtoupper($role->role) !!}</th>
                    @endforeach
                   @endif
               </tr>
           </thead>
           <tbody>
               @if ($permission_matrix)
                   @foreach ($permission_matrix as $group => $permissions)
                    <tr>
                        <th colspan="{!! (count($all_roles)+1) !!}">{!! strtoupper($group) !!}</th>
                    </tr>

                    @foreach ($permissions as $pid => $permission)
                    <tr>
                        <td>{!! $permission['permission']->display_name !!}</th>
                        @foreach ($permission['roles'] as $rid => $roles)
                            @if($rid == 1)
                                <td>{!! Form::checkbox('pm[]', $pid.'_'.$rid, true, array('disabled')) !!}</td>
                            @elseif ($roles['access'] == 1)
                                <td>{!! Form::checkbox('pm[]', $pid.'_'.$rid, true) !!}</td>
                            @else
                                <td>{!! Form::checkbox('pm[]', $pid.'_'.$rid) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                   @endforeach
                @endif
           </tbody>
   </table>
@endif

 <div class="form-group">

      {!! Form::submit('Save',array('class' => 'btn btn-primary')) !!}

  </div>
{!! Form::close() !!}
</div>
@endsection