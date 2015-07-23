@if(Auth::check())
@if(is_admin())
<nav class="navbar navbar-default navbar-static">
<div class="container-fluid">
  <ul class="nav navbar-nav">
    <li >{!! HTML::link('admin/userListing', 'All Users', array('class' => 'btn btn-link')) !!}</li>
     <li >{!! HTML::link('admin/roleListing', 'All Roles', array('class' => 'btn btn-link')) !!}</li>
    <li class="">{!! HTML::link('admin/permissionMatrix', 'Permission Matrix', array('class' => 'btn btn-link')) !!}</li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
    <li class="dropdown pull-right">
      <a href="#" id="navbarDrop1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome {!! strtoupper(Auth::user()->name) !!} <span class="caret"></span></a>
      <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
        <li>{!! HTML::link('users/myprofile', 'My Profile', array('class' => 'btn btn-link')) !!}</li>
        <li>{!! HTML::link('users/editProfile', 'Edit Profile', array('class' => 'btn btn-link')) !!}</li>
        <li>{!! HTML::link('users/changePassword', 'Change Password', array('class' => 'btn btn-link')) !!}</li>
        <li role="separator" class="divider"></li>
        <li>{!! HTML::link('users/logout', 'Logout', array('class' => 'btn btn-link')) !!}</li>
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
        <a href="#" id="navbarDrop1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome {!! strtoupper(Auth::user()->name) !!} <span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="navbarDrop1">
          <li>{!! HTML::link('users/myprofile', 'My Profile', array('class' => 'btn btn-link')) !!}</li>
          <li>{!! HTML::link('users/editProfile', 'Edit Profile', array('class' => 'btn btn-link')) !!}</li>
          <li>{!! HTML::link('users/changePassword', 'Change Password', array('class' => 'btn btn-link')) !!}</li>
          <li role="separator" class="divider"></li>
          <li>{!! HTML::link('users/logout', 'Logout', array('class' => 'btn btn-link')) !!}</li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
@endif
@endif