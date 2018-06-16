@extends('layouts.layoutForCalendar')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection

@section('content')
<input method="post" action="/avatars" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="file" name="image"/>
<button type="submit">Save image</button>
</form>
@endsection
