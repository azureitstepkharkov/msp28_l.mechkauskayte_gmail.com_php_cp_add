@extends('layouts.app')

@section('title', '| Users')
@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> User Administration
            @ability('Admin', 'adminperm')
            <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
            @endability
            <a href="{{ route('tasks.index') }}" class="btn btn-default pull-right">Tasks</a></h1>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                @ability('Admin', 'adminperm')
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>User Status</th>
                    <th colspan="3" style="text-align: center">Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                        <td>{{ Form::label($user->status, ucfirst($user->status)) }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                        </td>
                        <td>
                            @if($user->status == 'active')
                                {!! Form::open(['method' => 'PUT', 'route' => ['users.inactive', $user->id] ]) !!}
                                {!! Form::button(" Deactivate", array('type' => 'submit',
                                                            'class' => 'btn btn-danger btn-danger2',
                                                            'data-toggle'=>'confirmation',
                                                            'data-title'=>"Deactivate",
                                                            'data-content'=>"Deactivate user $user->name?",
                                                            'data-placement'=>"top",
                                                            'title'=>"")) !!}
                                {!! Form::close() !!}
                            @elseif($user->status == 'inactive')
                                {!! Form::open(['method' => 'PUT', 'route' => ['users.inactive', $user->id] ]) !!}
                                {!! Form::button(" Activate", array('type' => 'submit',
                                                            'class' => 'btn btn-danger btn-danger2',
                                                            'data-toggle'=>'confirmation',
                                                            'data-title'=>"Activate",
                                                            'data-content'=>"Activate user $user->name?",
                                                            'data-placement'=>"top",
                                                            'title'=>"")) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                            {!! Form::button("<i class='glyphicon glyphicon-trash'></i> Delete", array('type' => 'submit',
                            'class' => 'btn btn-danger btn-danger3',
                            'data-toggle'=>'confirmation',
                            'data-title'=>"Delete",
                            'data-content'=>"Delete user $user->name?",
                            'data-placement'=>"top",
                            'title'=>"")) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @endability
                @role('ProjectMan')
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>Technology</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->technologies()->pluck('name')->implode(', ') }}</td>
                        <td>{{ Form::label($user->status, ucfirst($user->status)) }}</td>
                    </tr>
                @endforeach
                </tbody>
                @endrole
                @role('TeamLeader')
                <thead>
                <tr>
                    <th>Programmer Name</th>
                    <th>Programmer Email</th>
                    <th>Technology</th>
                    <th>Programmer Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->technologies()->pluck('name')->implode(', ') }}</td>
                            <td>{{ Form::label($user->status, ucfirst($user->status)) }}</td>
                        </tr>
                @endforeach
                </tbody>
                @endrole
            </table>
            @ability('Admin', 'adminperm')
            <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
            @endability
        </div>
    </div>
@endsection