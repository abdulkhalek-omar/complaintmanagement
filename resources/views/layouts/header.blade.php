<!--  Header -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Omar Abdulkhalek">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    {{--    { config('app.name', 'Laravel') }}--}}

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
