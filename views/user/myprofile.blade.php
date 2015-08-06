@if ($layout)
    @extends($layout)
@endif

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-push-1" role="main">
            @include('users::partials.menubar')

            <h2>Welcome {!! strtoupper($user->name) !!}</h2>
            <br/>

            @include('users::errors.error-block')

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Display Name</th>
                    <td>{!! $user->name !!}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{!! $user->email !!}</td>
                </tr>
                <tr>
                    <th>Roles</th>
                    <td>
                        @foreach ($user_roles as $user_role)
                            <p> {!! $user_role->roles->role !!}</p>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
