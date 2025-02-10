<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    @include('layouts.partials.css')
    @stack('css-vendor')
    @stack('css')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('layouts.partials.sidebar')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('layouts.partials.header')
            <div id="main-content">
                <div class="page-heading">
                    @yield('content')
                </div>
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>
    @include('layouts.partials.js')
    @stack('js-vendor')
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
