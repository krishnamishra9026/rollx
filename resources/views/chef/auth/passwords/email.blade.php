<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password| Supplier</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured creator theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Cloudinc" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="favicon.png">

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />      
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-1 pb-1 text-center bg-tertiary">
                                <a href="{{ route('chef.login') }}">
                                    <span><img src="{{ asset('assets/images/logo.png') }}"></span>                                
                                </a>
                            </div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Reset Password</h4>
                                    <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                </div>

                                <form action="{{ route('chef.password.email') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" name="email" id="emailaddress" value="{{ old('email')}}">
                                        @error('email')
                                            <code id="email-error" class="text-danger">{{ $message }}</code>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-warning" type="submit"> Reset Password </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->

                        </div>
                        <!-- end card -->
                        {{-- <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="{{ route('creator.login') }}" class="text-muted ml-1"><b>Log In</b></a></p>
                            </div>
                        </div> --}}
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        {{-- <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © Cloudinc
        </footer> --}}

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

    </body>
</html>
