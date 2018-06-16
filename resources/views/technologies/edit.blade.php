@extends('layouts.app')

@section('title', '| Edit Technology')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>
        <h1><i class='fa fa-key'></i> {{__('Edit Technology')}}: {{$technology->name}}</h1>
        <hr>

        {{ Form::model($technology, array('route' => array('technologies.update', $technology->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Technology') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>

@endsection