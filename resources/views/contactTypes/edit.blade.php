@extends('layouts.app')

@section('title', '| Edit Contact Type')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>
        <h1><i class='fa fa-key'></i> {{__('Edit Contact Type')}}: {{$technology->name}}</h1>
        <hr>

        {{ Form::model($contactType, array('route' => array('contactType.update', $contactType->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('contact_type', 'Contact type') }}
            {{ Form::text('contact_type', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>

@endsection