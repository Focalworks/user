@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Permissions</h2>
            <br/>

            <div class="pull-right"><a href="{{ url('admin/addPermission') }}" class="btn btn-link" title="Add Permission"><span class="glyphicon glyphicon-plus"></span> Add New</a></div>
            <div class="clearfix"></div>
            @include('users::errors.error-block')

            @if ($permissions)
                <form action="{{ url('admin/permissions')  }}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table id="pmtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Groups</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                                @foreach ($permissions as $key => $permission)

                                        <tr>
                                            <td>{!! $permission->name !!}</td>
                                            <td>{!! $permission->display_name !!}</td>
                                            <td>{!! $permission->group !!}</td>

                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ url('admin/editPermission/'.$permission->pid) }}" class="btn btn-link" title="Edit Permission"><span class="glyphicon glyphicon-pencil"></span></a>

                                                        <a href="{{ url('admin/deletePermission/'.$permission->pid) }}" class="btn btn-link" title="Delete Permission" onclick="return confirm('Do you really want to delete this permission?')"><span class="glyphicon glyphicon-trash"></span></a>

                                                </div>
                                            </td>

                                        </tr>

                                @endforeach
                        </tbody>
                    </table>
                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-offset-2 col-sm-10">--}}
                            {{--<button class="btn btn-primary">Save</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </form>
            @endif
        </div>
    </div>
@endsection