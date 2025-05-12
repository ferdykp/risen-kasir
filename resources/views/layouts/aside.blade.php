{{-- <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start ms-4 vh-100 h-100 pb-5 overflow-hidden"
    id="sidenav-main"> --}}
<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 overflow-hidden "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center justify-content-center bg-primary text-white mx-auto py-2 rounded"
            href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-risen-white.png') }}" style="height: 80px; width: auto;"
                class="navbar-brand-img" alt="main_logo">
            <h4 class="mb-0">Risen+</h4>
        </a>




    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-100 overflow-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav ">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-9">Choose Menu</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gauge text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1 fw-bold">Dashboard</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('product') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('product') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1 fw-bold">Products</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link {{ request()->is('laundry') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('laundry') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1 fw-bold">Order</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('categories') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('categories') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1 fw-bold">Categories</span>
                </a>
            </li> --}}

        </ul>
    </div>
</aside>
