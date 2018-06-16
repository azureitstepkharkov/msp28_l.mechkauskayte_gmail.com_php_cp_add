@extends('layouts.app')

@section('title', '| Task')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> {{__("Task $task->name")}}</h1>
        <hr>
        <h3>Description:</h3>
        <div>{{$task->description}}</div>
        <hr>
        <span class="col-lg-7">
            <h3>Technologies:</h3>
            @if(!$technologies->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Technology')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($technologies as $tech)
                            <tr>
                                <td>{{ $tech->name }}
                                <td>{{ $tech->description }}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.detach_technology', $task->id, $tech->id] ]) !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Remove', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if(!empty($project_technologies))
                {{ Form::open(array('url' => "tasks/$task->id/attach_technology")) }}

                <div class="form-group">
                    {{ Form::label('technology', 'Available technologies:') }}
                    {{ Form::select('technology', $project_technologies)}}

                    {{ Form::submit('Add technology', array('class' => 'btn btn-primary')) }}
                </div>
                {{ Form::close() }}
            @endif
        </span>

        <span class="col-lg-5">
            <h3>Stuff:</h3>
            @if(!$stuff->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stuff as $s)
                            <tr>
                                <td>{{ $s->name }}
                                <td>
                                    {{--TODO: task - detuch_user --}}
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $tech->id] ]) !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Remove', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{--<a href="{{ URL::to('tasks/create') }}" class="btn btn-success">{{__('Add Task')}}</a>--}}
        </span>

        <span class="col-lg-12">
            <h3>Comments:</h3>
            @if(!$comments->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{__('Created')}}</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Text')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->created_at }}</td>
                                {{--TODO: user name in comments table--}}
                                <td>TODO: user name</td>
                                <td>{{ $comment->comment }}
                                <td>
                                    {{--TODO: task - detuch_comment --}}
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $tech->id] ]) !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Remove', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{--<a href="{{ URL::to('tasks/create') }}" class="btn btn-success">{{__('Add Task')}}</a>--}}
        </span>

        <span class="col-lg-12">
            <h3>Files:</h3>
            @if(!$files->isEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>{{__('Created')}}</th>
                            <th>{{__('Path')}}</th>
                            <th>{{__('User added')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->created_at }}</td>
                                {{--TODO: user name in files table--}}
                                <td>TODO: user name</td>
                                <td><a href="{{ url($file->path) }}">{{ $file->path }}</a>
                                <td>
                                    {{--TODO: task - detuch_file --}}
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $tech->id] ]) !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Remove', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            {{--<a href="{{ URL::to('tasks/create') }}" class="btn btn-success">{{__('Add Task')}}</a>--}}
        </span>

    </div>
    @endsection