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
</head>

<body>
    <section>
        <div class="white_box mb_30 m-5">
            <div class="row justify-content-center pt-3">
                <div class="col-lg-6">
                    <div class="modal-content cs_modal">
                        <div class="modal-header justify-content-center theme_bg_1">
                            <h5 class="modal-title text_white">Log in</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn_1 full_width text-center">
                                    Log in
                                </button>
                                <div class="text-center">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgot_password"
                                        data-bs-dismiss="modal" class="pass_forget_btn">Forget Password?</a>
                                </div>
                            </form>
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
