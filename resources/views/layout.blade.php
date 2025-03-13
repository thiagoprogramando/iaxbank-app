<!doctype html>

<html lang="pt-br" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-template="horizontal-menu-template-no-customizer" data-style="light">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <title>{{ env('APP_NAME') }} | {{ env('APP_DESCRIPTION') }}</title>

        <meta name="description" content=""/>

        <link rel="icon" type="image/x-icon" href="{{ asset('template/img/favicon/favicon.ico') }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet"/>

        <link rel="stylesheet" href="{{ asset('template/vendor/fonts/remixicon/remixicon.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/fonts/flag-icons.css') }}"/>

        <link rel="stylesheet" href="{{ asset('template/vendor/libs/node-waves/node-waves.css') }}"/>

        <link rel="stylesheet" href="{{ asset('template/vendor/css/rtl/core-dark.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/css/rtl/theme-default-dark.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/css/demo.css') }}" />

        <link rel="stylesheet" href="{{ asset('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/libs/typeahead-js/typeahead.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/libs/apex-charts/apex-charts.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/libs/swiper/swiper.css') }}"/>

        <link rel="stylesheet" href="{{ asset('template/vendor/css/pages/cards-statistics.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/css/pages/cards-analytics.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/vendor/css/pages/page-auth.css') }}"/>
        <link rel="stylesheet" href="{{ asset('template/css/auth.css') }}"/>

        <script src="{{ asset('template/vendor/js/helpers.js') }}"></script>
        <script src="{{ asset('template/js/config.js') }}"></script>
    </head>
    <body>

        @yield('content')
        
        <script src="{{ asset('template/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('template/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ asset('template/vendor/js/menu.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('template/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ asset('template/js/main.js') }}"></script>
        <script src="{{ asset('template/js/sweetalert.js') }}"></script>
        <script src="{{ asset('template/js/charts-apex.js') }}"></script>
        <script>
            @if(session('error'))
                Swal.fire({
                    title: 'Erro!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 2000
                })
            @endif

            @if(session('infor'))
                Swal.fire({
                    title: 'Atenção!',
                    text: '{{ session('infor') }}',
                    icon: 'info',
                    timer: 2000
                })
            @endif

            @if(session('success'))
                Swal.fire({
                    title: 'Sucesso!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 2000
                })
            @endif
        </script>
    </body>
</html>