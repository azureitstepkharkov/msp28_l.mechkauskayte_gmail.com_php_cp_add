@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>
        <h1><i class='fa fa-key'></i> Edit Task: {{$task->name}}</h1>
        <hr>

        {{ Form::model($task, array('route' => array('tasks.update', $task->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Task Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('start', 'Starts') }}
            {{ Form::date('start') }}
        </div>
        <div class="form-group">
            {{ Form::label('end', 'Ends') }}
            {{ Form::date('end')  }}
        </div>

        <div class="form-group">
            {{ Form::label('project_id', 'Project') }}
            {{ Form::select('project_id', $projects)}}
        </div>

        <div class="form-group">
            {{ Form::label('status', 'Status') }}
            {{ Form::select('status', $statuses)}}
        </div>

        @if (Auth::user()->hasRole('Client'))
            @foreach ($users as $user)
                <div class="form-group" style="display: none; visibility: hidden">
                {{ Form::checkbox('users[]',  $user->id, $task->users ) }}
                </div>
            @endforeach
        @else
            <div class='form-group'>
                {{ Form::label("Name", ucfirst("Name")) }} | {{ Form::label("Role", ucfirst("Role")) }}
                <br>
                @foreach ($users as $user)
                    {{ Form::checkbox('users[]',  $user->id, $task->users ) }}
                    {{ Form::label($user->name, ucfirst($user->name)) }} | {{ Form::label($user->roleName, ucfirst($user->roleName)) }}<br>
                @endforeach
            </div>
        @endif

        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>

@endsection