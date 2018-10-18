<!doctype html>
<html lang="en">
<head>
    @include('_includes.head')
</head>
<body>

    <div id="app">

        <header class="header-wrap">
            @include('_includes/header')
            @include('_includes/navigation')
        </header>

        @yield('content')

        @include('_includes.footer')

    </div>

        <!-- Script for polyfilling Promises on IE9/10/11 -->
        <script src='https://cdn.polyfill.io/v2/polyfill.min.js'></script>

        <script src="{{ mix('js/app.js') }}"></script>
        <script src="/js/fresco.js"></script>
        <script src="/js/bootstrap-select.js"></script>

    @section('bodyscript')
    @show

</body>
</html>