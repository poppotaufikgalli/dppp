@include('layouts.header')
<style type="text/css">
    html,
    body {
      height: 100%;
    }
</style>
<body class="d-flex align-items-center py-4 bg-tertiary-accent">
    @include('sweetalert::alert')
    @yield('content')
    @stack('scripts')
</body>
</html>