<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login | Employee Management System</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="5x5" href="{{ asset('/backend/assets/img/favicon/s.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Custom Global Font -->
    <style>
        * {
            font-family: 'Oxanium', sans-serif !important;
        }
    </style>

    <!-- Helpers -->
    <script src="{{ asset('/backend/assets/vendor/js/helpers.js') }}"></script>

    <!-- Theme Config -->
    <script src="{{ asset('/backend/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login Card -->
                <div class="card">
                    <div class="card-body" style="margin: 0;">

                        <!-- Logo -->
                        <div class="app-brand justify-content-center"
                            style="display: flex; flex-direction: column; align-items: center; margin: 15px;">
                            <a href="/" class="app-brand-link gap-2" style="text-align: center;">
                                <div
                                    style="display: flex; justify-content: center; align-items: center; width: 180px; height: 62px;">
                                    <span style="font-weight: 700; font-size: 28px;">Employee</span>
                                </div>
                            </a>
                            <p class="mb-4"
                                style="text-align: center; margin-top: 2px; font-weight: 500; font-size: 15px;">
                                Log into your account
                            </p>
                        </div>
                        <!-- /Logo -->

                        <!-- Form -->
                        <form action="{{ route('login') }}" method="POST" class="mb-3">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label d-flex justify-content-between">
                                    <span>Email</span>
                                </label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email" value="{{ old('email') }}" autofocus
                                    style="background: #30445C; color: #ffffff; border: 1px solid #30445C;" />
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- Password Field -->
                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label d-flex justify-content-between">
                                    <span>Password</span>
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter password" aria-describedby="toggle-password"
                                        style="background: #30445C; color: #ffffff; border: 1px solid #30445C;" />
                                    <span class="input-group-text cursor-pointer" id="toggle-password"
                                        style="background: #30445C; color: #ffffff; border: 1px solid #30445C;">
                                        <i class="bx bx-hide"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3">
                                <button type="submit" class="btn d-grid w-100"
                                    style="
                                        background: linear-gradient(94.57deg, #1DCDFE -0.65%, #35F5C6 135.25%);
                                        border: none;
                                        border-radius: 50px;
                                        color: #30445C !important;
                                        font-weight: 700;
                                        letter-spacing: 1px;
                                    ">
                                    LOGIN
                                </button>
                            </div>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
                <!-- /Login Card -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/backend/assets/js/main.js') }}"></script>

    <!-- GitHub Buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @include('sweetalert::alert')
</body>

</html>
