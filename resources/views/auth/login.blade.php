<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from demo.dashboardpack.com/sales-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Feb 2023 07:11:00 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sales</title>

    <link rel="stylesheet" href="{{ asset('pages') }}/css/bootstrap1.min.css" />

    <link rel="stylesheet" href="{{ asset('pages') }}/vendors/themefy_icon/themify-icons.css" />
    <link rel="stylesheet" href="{{ asset('pages') }}/vendors/font_awesome/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('pages') }}/vendors/scroll/scrollable.css" />

    <link rel="stylesheet" href="{{ asset('pages') }}/css/metisMenu.css" />

    <link rel="stylesheet" href="{{ asset('pages') }}/css/style1.css" />
    <link rel="stylesheet" href="{{ asset('pages') }}/css/colors/default.css" id="colorSkinCSS" />
    <style>
        label {
            font-weight: 500;
        }

        .form-control-lg {
            font-size: 1rem;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        @media (min-width: 767px) {
            span {
                color: #1c1f23;
                font-size: 27px;
                line-height: 30px;
            }
        }

        @media (max-width: 767px) {
            span {
                color: #1c1f23;
                font-size: 16px;
                line-height: 30px;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100" style="background-color: #1C4B7F">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block text-center">
                                <img src="{{ asset('pages/img/saleslogin.png') }}" alt="login form"
                                    class="img-fluid p-5" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h fw-bold mb-0">DATA ROCKET CAR CUSTOMER
                                                (DRCC)</span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-1" style="letter-spacing: 1px;">Sign into your
                                            account</h5>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Email</label>
                                            <input id="email" type="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" autocomplete="email"
                                                autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input id="password" type="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password" autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit"
                                                style="width:100%">Login</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('pages') }}/js/jquery1-3.4.1.min.js"></script>

    <script src="{{ asset('pages') }}/js/popper1.min.js"></script>

    <script src="{{ asset('pages') }}/js/bootstrap.min.html"></script>

    <script src="{{ asset('pages') }}/js/metisMenu.js"></script>

    <script src="{{ asset('pages') }}/vendors/scroll/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('pages') }}/vendors/scroll/scrollable-custom.js"></script>

    <script src="{{ asset('pages') }}/js/custom.js"></script>
</body>

<!-- Mirrored from demo.dashboardpack.com/sales-html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Feb 2023 07:11:00 GMT -->

</html>
