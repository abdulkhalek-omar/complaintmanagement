@section('title', 'Register')

<x-app-layout>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo"
                             width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{--                                --}}
                                {{--                                <div class="mb-3">--}}
                                {{--                                    <label class="mb-2 text-muted" for="name">Name</label>--}}
                                {{--                                    <input id="name" type="text" class="form-control" name="name" value="" required=""--}}
                                {{--                                           autofocus="">--}}
                                {{--                                    <div class="invalid-feedback">--}}
                                {{--                                        Name is required--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
{{--                                    @if ($errors->has('email'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('email') }}</span>--}}
{{--                                    @endif--}}
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="c-password">Repeat Password</label>
                                    <input id="c-password" type="password" class="form-control" name=c_password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <p class="form-text text-muted mb-3">
                                    By registering you agree with our terms and condition.
                                </p>

                                <div class="align-items-center d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto">Register</button>
                                </div>

                            </form>

                        </div>

                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Already have an account? <a href="{{ route('login') }}" class="text-dark">Login</a>
                            </div>
                        </div>

                    </div>
                    <div class="text-center mt-5 text-muted">
                        Copyright © 2021-2022 — FHDW
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
