<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Charting library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


</head>
<body class="font-sans antialiased bg-light">
<x-jet-banner/>
@livewire('navigation-menu')

<!-- Page Heading -->
<header class="d-flex py-3 bg-white shadow-sm border-bottom">
    <div class="container">
        {{ $header }}
    </div>
</header>

<!-- Page Content -->
<main class="container my-5">
    {{ $slot }}
</main>

@stack('modals')

@livewireScripts

@stack('scripts')
</body>
</html>
