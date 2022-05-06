<x-app-layout>
{{--    --}}
{{--    <div style="margin-bottom: 4rem!important; ">--}}
{{--        <nav class="navbar navbar-dark bg-dark fixed-top">--}}
{{--            <div class="container-fluid text-light">--}}
{{--                <a class="navbar-brand" href="{{ route('tickets.index') }}">{{ config('app.name', 'Laravel') }}</a>--}}

{{--                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"--}}
{{--                        data-bs-target="#offcanvasNavbar"--}}
{{--                        aria-controls="offcanvasNavbar">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"--}}
{{--                     aria-labelledby="offcanvasNavbarLabel">--}}
{{--                    <div class="offcanvas-header bg-dark">--}}
{{--                        <h5 class="offcanvas-title text-light"--}}
{{--                            id="offcanvasNavbarLabel">{{ config('app.name', 'Laravel') }}</h5>--}}
{{--                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"--}}
{{--                                aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                    <div class="offcanvas-body bg-dark">--}}
{{--                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">--}}
{{--                            <!-- Authentication Links -->--}}
{{--                            @guest--}}
{{--                                @if (Route::has('login'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" aria-current="page"--}}
{{--                                           href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (Route::has('register'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (!Auth::check())--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link"--}}
{{--                                           href="{{ route('tickets.index') }}">{{ __('Ticket management') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (!Auth::check())--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link"--}}
{{--                                           href="{{ route('complaints') }}">{{ __('Complaints management') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                            @else--}}
{{--                                <li class="nav-item dropdown">--}}
{{--                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                        {{ Auth::user()->name }}--}}
{{--                                    </a>--}}

{{--                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                           onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                            {{ __('Logout') }}--}}
{{--                                        </a>--}}

{{--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                              class="d-none">--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            @endguest--}}
{{--                        </ul>--}}

{{--                        <br/>--}}
{{--                        <form class="d-flex">--}}
{{--                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                            <button class="btn btn-outline-success" type="submit">Search</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </div>--}}

</x-app-layout>
