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
        <div class="position-relative">
            <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
                <div class="authentication-inner py-6">
                    <div class="card p-md-7 p-1">
                        <div class="app-brand justify-content-center mt-5">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"> </span>
                                <span class="app-brand-text demo fw-semibold text-white">{{ env('APP_NAME') }}</span>
                            </a>
                        </div>
        
                        <div class="card-body mt-1">
                            <h4 class="mb-1 text-white">Bem-vindo(a)! 👋</h4>
                            <p class="mb-5 text-white">Faça login na sua conta para ter acesso aos benefícios.</p>
            
                            <form id="formAuthentication" class="mb-5" action="{{ route('logon') }}" method="POST">
                                @csrf
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail:"/>
                                    <label for="email">E-mail</label>
                                </div>
                                <div class="mb-5">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Senha:" aria-describedby="password"/>
                                                <label for="password">Senha</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer">
                                                <i class="ri-eye-off-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5 d-flex justify-content-between mt-5">
                                    <div class="form-check mt-2">
                                        {{-- <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Remember Me </label> --}}
                                    </div>
                                    <a href="auth-forgot-password-basic.html" class="float-end mb-1 mt-2 text-white">
                                        <span>Esqueceu a senha?</span>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Acessar</button>
                                </div>
                            </form>
            
                            <p class="text-center text-white">
                                <i>V <a href="#" target="_blank" class="text-white">0.0.1</a></i> 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <script src="{{ asset('template/js/charts-apex.js') }}"></script>
    </body>
</html>
