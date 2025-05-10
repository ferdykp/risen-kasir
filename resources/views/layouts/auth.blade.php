<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @stack('head')
</head>

<body>
    @yield('content')

    @include('layouts.footer')
    @include('layouts.script')
    @include('components.toast')
</body>

</html>
