@extends('layouts.app')

@section('title', '| Technologies')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> {{__('Technologies')}}

            {{--<a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>--}}
            {{--<a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>--}}
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{__('Technology')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->name }}</td>
                        <td>{{ $technology->description }}</td>
                        <td>
                            <a href="{{ URL::to('technologies/'.$technology->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">{{__('Edit')}}</a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['technologies.destroy', $technology->id] ]) !!}
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ URL::to('technologies/create') }}" class="btn btn-success">{{__('Add Technology')}}</a>

    </div>
@endsection
