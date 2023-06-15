<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>

    @include('layouts.admin.css')

    @stack('add-style')
</head>

<body class="crm_body_bg">


    @include('layouts.admin.sidabar')

    <section class="main_content dashboard_part large_header_bg">

        @include('layouts.admin.navbar')

        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">
                @yield('content')
            </div>
        </div>
        @stack('modal')
        @include('layouts.admin.footer')>
    </section>

    @include('layouts.admin.script')

    @stack('add-script')

</body>

</html>
