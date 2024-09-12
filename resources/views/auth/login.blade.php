@extends('layouts.master-without-nav')
@section('title')
    Login
@endsection
@section('page-title')
    Login
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="mb-4 pb-2">
                                <a href="index" class="d-block auth-logo">
                                    <h3 class="auth-logo-dark me-start text-center fw-bold">
                                        SantriQ
                                    </h3>
                                    <p class="auth-logo-light me-start text-center fw-bold">
                                        SantriQ
                                    </p>
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to SantriQ.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('login') }}" class="auth-input">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                                    value="admin@themesbrand.com">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                </div>
                                                <label class="form-label" for="password-input">Password <span
                                                        class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                    <span class="bx bx-lock-alt"></span>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Enter password" id="password-input" name="password"
                                                        required autocomplete="current-password" value="12345678">
                                                    <button type="button"
                                                        class="btn btn-link position-absolute h-100 end-0 top-0"
                                                        id="password-addon">
                                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}
                                                    value="{{ true }}">
                                                <label class="form-check-label" for="remember">Remember
                                                    me</label>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign
                                                    In</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                </div>
            </div><!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/pages/pass-addon.init.js') }}"></script>
    @endsection
