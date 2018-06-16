<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.partials._head')
<body>

@yield('content')

@include('layouts.partials._scriptsFooter')
</body>
</html>