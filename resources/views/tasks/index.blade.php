@extends('layouts.app')

@section('title', '| Tasks')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> {{__('Tasks')}}
{{--            <a href="{{ route('projects.index') }}" class="btn btn-default pull-right">Projects</a>--}}
        </h1>
        <hr>
        @if(!$tasks->isEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('Task')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Project')}}</th>
                    <th>{{__('Starts')}}</th>
                    <th>{{__('Ends')}}</th>
                    <th>{{__('Status')}}</th>
                    @if (Auth::user()->hasRole('ProjectMan') || Auth::user()->hasRole('TeamLeader')
                        || Auth::user()->hasRole('Admin'))
                        <th>{{__('Stuff')}}</th>
                        <th>{{__('Operation')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    {{--TODO: uncomment when Project model will be created--}}
{{--                    @if(App\models\Project::where('id', $task->project_id)->first()->clients_id == Auth::user()->id)--}}
                    <tr>
                        {{--<td><a href="{{url("tasks/$task->id")}}">{{ $task->name }}</a></td>--}}
                        <td><a href="{{route("tasks.show", ['id' => $task->id])}}">{{ $task->name }}</a></td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->project_id }}</td>{{-- TODO: change project_id on project name (when project model will be created) --}}
                        <td>{{ $task->start }}</td>
                        <td>{{ $task->end }}</td>
                        <td>{{ $task->status }}</td>
                        @if (Auth::user()->hasRole('ProjectMan') || Auth::user()->hasRole('TeamLeader')
                        || Auth::user()->hasRole('Admin'))
                            <td>{{ $task->users()->pluck('name')->implode(', ')  }}</td>
                            <td>
                                <a href="{{ URL::to('tasks/'.$task->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->id] ]) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                {{--@endif--}}
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if (Auth::user()->hasRole('ProjectMan') || Auth::user()->hasRole('TeamLeader')
                        || Auth::user()->hasRole('Admin')|| Auth::user()->hasRole('Client'))
            <a href="{{ URL::to('tasks/create') }}" class="btn btn-success">{{__('Add Task')}}</a>
        @endif
    </div>
@endsection
