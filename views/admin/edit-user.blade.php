@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Edit User : {!! $user->name !!}</h2>
            <br/>

            @include('users::errors.error-block')

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
                    <?php $user_roles = get_user_roles(Auth::user()->id); ?>
                        @foreach($roles as $aKey => $aRole)
                            @if($aRole->rid == 1)
                                @if(in_array(1,$user_roles))
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="roles[]" value="{{$aRole->rid}}" @if(in_array($aRole->rid,$user_roles))checked="checked"@endif >  {{$aRole->role}}
                                        </label>
                                    </div>
                                @endif
                            @else
                                <div class="checkbox @if($aRole->rid == 2) disabled @endif">
                                    <label>
                                        <input type="checkbox" name="roles[]" value="{{$aRole->rid}}" @if(in_array($aRole->rid,$user_roles))checked="checked"@endif @if($aRole->rid == 2) disabled="disabled" @endif>  {{$aRole->role}}
                                    </label>
                                </div>
                            @endif
                        @endforeach
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