@if ($layout)
    @extends($layout)
@endif
<div class="col-md-9" role="main">
 <div class="alert alert-danger">
 You don't have accecc to this page...{!! HTML::link('users/login', 'Go to Home Page', array('class' => 'btn btn-default')) !!}
 </div>
 </div>
