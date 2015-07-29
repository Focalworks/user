@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 well col-md-push-1" role="main">
            @include('users::menubar')

            <h2>Edit User : {!! $user->name !!}</h2>
            <br/>

            @if(Session::has('error'))
                <div class="alert alert-danger">{!! Session::get('error') !!}</div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif

            <form action="{{ url('admin/saveUserProfile')  }}" method="POST" class="form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Display Name</label>

                    <div class="col-sm-6">
                        <input type="text" name="password" class="form-control" placeholder="New Password" value="{{ isset($user->name) ? $user->name : Input::old('name') }}">

                        <p class="text-danger">{!! $errors->first('name') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Select Roles</label>

                    <div class="col-sm-6">
                        <select multiple="multiple" name="roles[]" id="roles" class="form-control">
                            @foreach($roles as $aKey => $aRole)
                                @if($aRole->rid > 2)
                                    <option value="{{$aRole->rid}}" @if(in_array($aRole->rid,$user_roles))selected="selected"@endif>{{$aRole->role}}</option>
                                @endif
                            @endforeach
                        </select>

                        <p class="text-danger">{!! $errors->first('roles') !!}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/userListing')  }}" class="btn btn-link">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection