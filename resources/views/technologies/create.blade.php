@extends('layouts.app')

@section('title', '| Add Technology')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> {{__('Add Technology')}}</h1>
        <hr>

        {{ Form::open(array('url' => 'technologies')) }}

        <div class="form-group">
            {{ Form::label('name', 'Technology') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div><div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection