<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @stack('head')
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-400 position-absolute w-100"
        style="background-image: url('/assets/img/bg-kasirku.png'); background-size: cover; background-position: center; background-repeat: no-repeat; opacity: 0.8;">
    </div>

    @include('layouts.aside')

    <main class="main-content position-relative border-radius-lg ">
        @include('layouts.navbar')

        @yield('content')

    </main>

    @include('layouts.footer')
    @include('layouts.script')
    @include('components.toast')
    @stack('customScript')
</body>

</html>
