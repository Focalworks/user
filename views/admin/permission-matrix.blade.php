@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Permission Matrix</h2>
            <br/>

            @include('users::errors.error-block')

            @if ($permission_matrix)
                <form action="{{ url('admin/permissionMatrix')  }}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                                    <td><input type="checkbox" name="pm[]" value="{{ $pid.'_'.$rid }}" checked disabled/></td>
                                                @elseif ($roles['access'] == 1)
                                                    <td><input type="checkbox" name="pm[]" value="{{ $pid.'_'.$rid }}" checked/></td>
                                                @else
                                                    <td><input type="checkbox" name="pm[]" value="{{ $pid.'_'.$rid }}"/></td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                            <button class="btn btn-primary">Save</button>
                      
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection