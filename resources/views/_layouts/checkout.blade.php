<!doctype html>
<html lang="en">
<head>
    @include('_includes.head')
</head>
<body>
    <div id="app">

        <header class="header-wrap">
            @include('_includes/checkoutHeader')
        </header>

        @yield('content')

        {{-- @include('_includes.footer') --}}

    </div>
    @section('bodyscript')
        <script src="https://use.fontawesome.com/2633bba861.js"></script>
        <script src="/js/app.js"></script>
    @show
</body>
</html>