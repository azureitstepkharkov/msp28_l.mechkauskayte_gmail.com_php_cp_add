@extends('layouts.app')
@section('title', '| contactType')

@section('content')

    <div class="col-lg-10 col-lg-offset-1">
        <h1><i class="fa fa-key"></i> {{__('Contact Type')}}
            {{--            <a href="{{ route('projects.index') }}" class="btn btn-default pull-right">Projects</a>--}}
        </h1>
        <hr>
        @if(!$contactTypes->isEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>{{__('Contact type')}}</th>
                        <th>{{__('Operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contactTypes as $contactTypes)
                        <tr>
                            <td><a href="{{route("contactTypes.show", ['id' => $contactTypes->id])}}">{{ $contactTypes->contact_type }}</a></td>
                            <td>
                                <a href="{{ URL::to('contactTypes/'.$contactTypes->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">{{__('Edit')}}</a>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['contactTypes.destroy', $contactTypes->id] ]) !!}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ URL::to('contactType/create') }}" class="btn btn-success">{{__('Add Contact Type')}}</a>
    </div>
@endsection

