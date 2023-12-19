<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/smart_scholl-only_icon.png') }}">

    <title>
        Smart School
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.5') }}" rel="stylesheet" />
    <style>
        .field-icon {
            right: 10px;
            top: 50%;
            position: absolute;
            z-index: 100;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

</head>

<body class="bg-gray-200">
    @include('sweetalert::alert')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('{{ asset('assets/img/a.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0" style=""><img
                                            src="{{ asset('assets/img/smart_scholl-only_icon.png') }}"
                                            alt="HTML tutorial" style="height: 90px;filter:brightness(0%) invert(90%)">
                                    </h4>
                                    <div class="row mt-2">
                                        {{-- <h4 class="text-white font-weight-bolder text-center mb-0">Smart School</h4> --}}
                                        <p class=" text-white text-center mb-0 mt-1 ">Silahkan masuk untuk
                                            melanjutkan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="/login" method="post" role="form" class="text-start">
                                    @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required
                                            value="{{ old('username') }}"
                                            @error('username')
                                                {{ 'autofocus' }}
                                            @enderror>
                                    </div>
                                    <div class="input-group input-group-outline mb-3 position-relative">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required
                                            id="password-field"
                                            @isset($toast_error)
                                                {{ 'autofocus' }}
                                            @endisset
                                            @error('password')
                                                {{ 'autofocus' }}
                                            @enderror>
                                        <span data-target="#password-field"
                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                    </div>

                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-primary w-100 my-3 mb-2">MASUK</button>
                                    </div>
                                </form>
                                <div>
                                    <style>
                                        .teks-style {
                                            font-size: 18px;
                                            font-family: 'italic', Times, serif;
                                        }
                                    </style>
                                    <a href="{{ route('daftar-tamu') }}" class="teks-style"
                                        style="text-decoration-line: initial;">
                                        Silahkan klik untuk Tamu
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.5') }}"></script>
    <script>
        $(document).on('click', '.toggle-password', function(e) {
            e.preventDefault();
            let target = $($(this).attr('data-target'))
            if (target.attr('type') == 'password') {
                target.attr('type', 'text')
                $(this).addClass('fa-eye-slash')
            } else {
                target.attr('type', 'password')
                $(this).removeClass('fa-eye-slash')
            }
        })
    </script>
</body>

</html>
