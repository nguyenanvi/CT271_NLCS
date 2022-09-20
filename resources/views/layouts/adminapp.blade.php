<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nhà thuốc Sức Khỏe') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/uikit.css') }}" rel="stylesheet">
</head>
<body style="min-height: 100vh">
<div id="app">
    <div class="uk-background-secondary uk-light uk-position-z-index" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
        <nav class="uk-navbar-container uk-navbar-transparent">
            <div class="uk-container">
                <div class="uk-navbar" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="{{route('admin.home')}}">{{ config('app.name', 'Laravel') }}</a>
                        <ul class="uk-navbar-nav">
                        </ul>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-iconnav"> 
                            {{-- Authentication Links --}}
                            @auth('admin')
                            <li>
                                    <span uk-icon="icon:user"></span>   
                                    <div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-nav-header">
                                                {{Auth::guard('admin')->user()->name}}
                                            </li>
                                            <li class="uk-nav-divider"></li>
                                            <li>
                                                @if (Route::has('admin.register'))
                                                        <a href="{{ route('admin.register') }}">{{ __('Đăng ký') }}</a>
                                                @endif
                                                <a href="{{ route('admin.logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('Đăng xuất') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @else
                                @if (Route::has('admin.login'))
                                    <li>
                                        <a href="{{ route('admin.login') }}">{{ __('Đăng nhập') }}</a>
                                    </li>
                                @endif
                                

                                
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
    <main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">
        <div class="uk-container">
            @includeIf('layouts.generalmessage')
            @yield('content')
        </div>
    </main>

    <footer class="uk-section uk-section-xsmall uk-section-secondary">
        <div class="uk-container">
            <div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
                <div class="uk-text-small uk-text-muted uk-width-1-3@s">
                    ViB1910178@student.ctu.edu.vn
                </div>
                <div class="uk-text-center uk-width-1-3@s">
                    <a target="_blank" href="https://github.com/NguyenAnVi/CT271_NLCS"
                       class="uk-icon-button" data-uk-icon="github"></a>
                </div>
                <div class="uk-text-small uk-text-muted uk-text-center uk-text-right@s uk-width-1-3@s">
                    Built with <a target="_blank" href="http://getuikit.com"><span data-uk-icon="uikit"></span></a>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('js/uikit.js') }}" defer></script>
<script src="{{ asset('js/uikit-icons.js') }}" defer></script>

</body>
</html>
