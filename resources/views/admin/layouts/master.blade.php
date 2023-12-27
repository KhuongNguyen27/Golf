<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Golf is Life | Manager Member </title>
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('admin/assets/defaul.png') }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/defaul.png') }}">
    <meta name="theme-color" content="#3063A0">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('admin/assets/stylesheets/custom.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
    var skin = localStorage.getItem('skin') || 'default';
    var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
    disabledSkinStylesheet.setAttribute('rel', '');
    disabledSkinStylesheet.setAttribute('disabled', true);
    document.querySelector('html').classList.add('loading');
    </script>
    yield('header')
</head>

<body>
    <div class="app">
        <header class="app-header app-header-dark">
            @include('admin.includes.header');
        </header>
        <aside class="app-aside app-aside-expand-md app-aside-light">
            <div class="aside-content">
                @include('admin.includes.sidebar');
                {{--  @include('admin.includes.footer'); --}}
            </div>
        </aside>
        <main class="app-main">
            <div class="wrapper">
                <div class="page">
                    <div class="page-inner">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    yield('footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('admin/assets/javascript/theme.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/src/app.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');

    var button = document.querySelector('.hamburger');
    var appDiv = document.querySelector('.app');

    function toggleClass() {
        appDiv.classList.toggle('has-compact-menu');
    }
    button.addEventListener('click', toggleClass);
    </script>
</body>

</html>