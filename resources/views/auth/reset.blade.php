<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets') }}/images/favicon-32x32.png" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/icons.css" rel="stylesheet">
    <!-- toastr CSS -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>Reset Password</title>
</head>

<body>
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="mb-4 text-center">
                                        <img src="{{ asset('assets') }}/images/logo-icon.png" width="60"
                                            alt="" />
                                    </div>
                                    <div class="text-start mb-4">
                                        <h5 class="">Genrate New Password</h5>
                                        <p class="mb-0">We received your reset password request. Please enter your new
                                            password!</p>
                                    </div>
                                    <form action="{{ route('resetPassword', ['token' => $user->remember_token]) }}"
                                        method="post">
                                        @csrf
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">New Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password"
                                                class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                                placeholder="Enter new password" /> @error('password')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Confirm Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="confirm_password"
                                                class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                                placeholder="Confirm password" /> @error('email')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Change Password</button> <a
                                                href="{{ route('loginPage') }}" class="btn btn-light"><i
                                                    class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->

    <!-- Toastr-->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
