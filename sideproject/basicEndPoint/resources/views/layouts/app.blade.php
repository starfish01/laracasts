@include('layouts.core.header')

<body>
    <div id="app">
        @include('layouts.core.nav')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
