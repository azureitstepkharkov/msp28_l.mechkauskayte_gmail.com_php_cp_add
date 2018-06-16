@extends('layouts.app')

@section('title', '| Add Task')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> {{__('Add Task')}}</h1>
        <hr>

        {{ Form::open(array('url' => 'tasks')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div><div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('start', 'Starts') }}
            {{ Form::date('start', \Carbon\Carbon::now()) }}
        </div>
        <div class="form-group">
            {{ Form::label('end', 'Ends') }}
            {{ Form::date('end', \Carbon\Carbon::now()) }}
        </div>

        <div class="form-group">
            {{ Form::label('project_id', 'Project') }}
            {{ Form::select('project_id', $projects)}}
        </div>

        <div class="form-group">
            {{ Form::label('status', 'Status') }}
            {{ Form::select('status', $statuses)}}
        </div>
        <br>
        @if (Auth::user()->hasRole('Client'))
            <div class='form-group' style="display: none; visibility: hidden">
            {{ Form::checkbox('users',  Auth::user()->id, true ) }}
            </div>
            @else
            <h5><b>Assign Employee</b></h5>
            <br>
            <div class='form-group'>
                {{ Form::label("Name", ucfirst("Name")) }} | {{ Form::label("Role", ucfirst("Role")) }}
                <br>
                @foreach ($users as $user)
                    {{ Form::checkbox('users[]',  $user->id, false ) }}
                    {{ Form::label($user->name, ucfirst($user->name)) }} | {{ Form::label($user->roleName, ucfirst($user->roleName)) }}<br>
                @endforeach
            </div>
            @endif

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection