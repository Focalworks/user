@if(Auth::check())
    <nav class="navbar navbar-default navbar-static">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('users/dashboard')  }}" class="btn btn-link">Dashboard</a></li>

                @if(access_check('manage_users',true) || access_check('manage_permisssion_matrix',true) || access_check('manage_permisssions',true) || access_check('manage_roles',true))
                    <li class="dropdown">
                        <a href="#" id="navDropAdmin" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">Admin Functions<span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
                            @if(access_check('manage_users',true))
                                <li><a href="{{ url('admin/userListing') }}" class="btn btn-link">All Users</a></li>
                            @endif
                            @if(access_check('manage_roles',true))
                                <li><a href="{{ url('admin/roleListing') }}" class="btn btn-link">All Roles</a></li>
                            @endif
                            @if(access_check('manage_permisssions',true))
                                <li><a href="{{ url('admin/permissionsListing')}}" class="btn btn-link">Permissions</a></li>
                            @endif
                            @if(access_check('manage_permission_matrix',true))
                                <li class=""><a href="{{ url('admin/permissionMatrix')  }}" class="btn btn-link">Permission Matrix</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown pull-right">
                    <a href="#" id="navbarDrop1" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <p class="text-info"><span class="glyphicon glyphicon-user"></span>
                            Welcome {!! ucfirst(Auth::user()->name) !!} <span class="caret"></span></p></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
                     @if(access_check('manage_profile',true))
                        <li><a href="{{ url('users/myprofile')  }}" class="btn btn-link">My Profile</a></li>
                        <li><a href="{{ url('users/editProfile')  }}" class="btn btn-link">Edit Profile</a></li>
                        <li><a href="{{ url('users/changePassword')  }}" class="btn btn-link">Change Password</a>
                        </li>
                     @endif
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('users/logout')  }}" class="btn btn-link">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
@endif