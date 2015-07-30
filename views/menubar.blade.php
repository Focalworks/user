@if(Auth::check())
    <div class="row">
        @if(is_admin())
            <nav class="navbar navbar-default navbar-static">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li ><a href="{{ url('admin/userListing')  }}" class="btn btn-link">All Users</a></li>
                        <li ><a href="{{ url('admin/roleListing')  }}" class="btn btn-link">All Roles</a></li>
                        <li ><a href="{{ url('admin/permissionsListing')  }}" class="btn btn-link">Permissions</a></li>
                        <li class=""><a href="{{ url('admin/permissionMatrix')  }}" class="btn btn-link">Permission Matrix</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown pull-right">
                            <a href="#" id="navbarDrop1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><p class="text-info"> <span class="glyphicon glyphicon-user"></span>  Welcome {!! strtoupper(Auth::user()->name) !!} <span class="caret"></span> </p> </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
                                <li><a href="{{ url('users/myprofile')  }}" class="btn btn-link">My Profile</a></li>
                                <li><a href="{{ url('users/editProfile')  }}" class="btn btn-link">Edit Profile</a></li>
                                <li><a href="{{ url('users/changePassword')  }}" class="btn btn-link">Change Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('users/logout')  }}" class="btn btn-link">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        @else
            <nav class="navbar navbar-default navbar-static">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown pull-right">
                            <a href="#" id="navbarDrop1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><p class="text-info"> <span class="glyphicon glyphicon-user"></span>  Welcome {!! strtoupper(Auth::user()->name) !!} <span class="caret"></span></p></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
                                <li><a href="{{ url('users/myprofile')  }}" class="btn btn-link">My Profile</a></li>
                                <li><a href="{{ url('users/editProfile')  }}" class="btn btn-link">Edit Profile</a></li>
                                <li><a href="{{ url('users/changePassword')  }}" class="btn btn-link">Change Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('users/logout')  }}" class="btn btn-link">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif
    </div>
@endif