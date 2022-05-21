<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Globals */

        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none; /* Prevent inheritance from `body` */
        }


        /* Base structure */
        body {
            text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .cover-container {
            max-width: 42em;
        }

        /* Header */
        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 800;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

    </style>

</head>

<body class="d-flex h-100 text-center text-white bg-dark">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">Management</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
                    @else
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a href="{{ route('login') }}" class="nav-link text-muted">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link ms-4 text-muted">Register</a>
                        @endif
                    @endif
                @endif
            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>Cover your page.</h1>
        <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the
                        text, and add your own fullscreen background photo to make it your own.</p>
        <p class="lead">
            <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Learn more</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a
                href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
    </footer>
</div>

</body>
</html>
