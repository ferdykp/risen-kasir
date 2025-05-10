<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-1 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-1">
        @php
            $segments = request()->segments();
            $lastSegment = end($segments);
            $breadcrumb = ucfirst(str_replace('-', ' ', $lastSegment));
        @endphp

        <div class="p-2 rounded-xl bg-primary">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-0 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-15 text-white" href="{{ url('/dashboard') }}">Home</a>
                    </li>
                    @foreach ($segments as $index => $segment)
                        @php
                            $url = url(implode('/', array_slice($segments, 0, $index + 1)));
                            $isLast = $loop->last;
                        @endphp
                        <li class="breadcrumb-item text-sm {{ $isLast ? 'text-white active' : '' }}"
                            aria-current="{{ $isLast ? 'page' : '' }}">
                            @if ($isLast)
                                {{ ucfirst(str_replace('-', ' ', $segment)) }}
                            @else
                                <a class="opacity-75 text-white"
                                    href="{{ $url }}">{{ ucfirst(str_replace('-', ' ', $segment)) }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav justify-content-end">
                <!-- User Dropdown -->
                <div class="bg-primary rounded-lg px-2">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle text-white font-weight-bold px-0" id="navbarDropdown"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                            aria-haspopup="true">
                            <i class="ni ni-single-02 text-sm opacity-10"></i>
                            <span class="d-sm-inline d-none ms-2">Halo, {{ auth()->user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" style="top:.5rem !important;"
                            aria-labelledby="navbarDropdown">
                            <li>
                                {{-- @if (Auth::user()->role == 'admin')
                                    <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                                        <i class="ni ni-circle-08 text-dark text-sm opacity-10 me-2"></i> Profile
                                    </a>
                                @endif --}}
                                <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                    <i class="ni ni-curved-next text-dark text-sm opacity-10 me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>

                <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center mx-3">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>
