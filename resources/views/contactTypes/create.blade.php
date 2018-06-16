@extends('layouts.app')

@section('title', '| Add Contact Type')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-key'></i> {{__('Add Contact Type')}}</h1>
        <hr>

        {{ Form::open(array('url' => 'contact_types')) }}

        <div class="form-group">
            {{ Form::label('contact_type', 'Contact type') }}
            {{ Form::text('contact_type', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection