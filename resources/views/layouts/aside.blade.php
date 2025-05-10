{{-- <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start ms-4 vh-100 h-100 pb-5 overflow-hidden"
    id="sidenav-main"> --}}
<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 overflow-hidden"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 bg-primary text-white }}" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-master.png') }}" width="40px" height="40px"
                class="navbar-brand-img h-100 inline" alt="main_logo">
            {{-- <span class="ms-3 font-weight-bold">Risen+</span> --}}
            <h4 class="inline font-wh">Risen+</h2>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-100 overflow-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
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
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('product') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('product') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('laundry') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('laundry') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laundry</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('categories') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('categories') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-circle-exclamation text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">categories</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('manualbook') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('manualbook') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-book text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Manual Book</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('audit') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('audit') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-folder-open text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Audit Dokumen</span>
                </a>
            </li> --}}

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('maintenance') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="{{ route('maintenance') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-solid fa-calendar-days text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jadwal Maintenance</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->is('sparepart') || request()->is('tracking') ? 'bg-primary text-white rounded-lg' : '' }}"
                    href="#" id="sparepartDropdown" role="button" data-bs-toggle="collapse"
                    data-bs-target="#sparepartMenu" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gear text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sparepart</span>
                </a>
                <div class="collapse  {{ request()->is('sparepart*') || request()->is('tracking*') ? 'show' : '' }}"
                    id="sparepartMenu">
                    <ul class="nav flex-column ms-3 my-2">
                        <li class="nav-item">
                            <a class="nav-link p-2 {{ request()->is('sparepart*') ? 'active bg-light rounded' : '' }}"
                                href="{{ route('sparepart') }}">
                                <i class="fa-solid fa-truck-ramp-box"></i>
                                Inventory Sparepart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2 {{ request()->is('tracking*') ? 'active bg-light rounded' : '' }}"
                                href="{{ route('tracking') }}">
                                <i class="fa-solid fa-truck-moving"></i>
                                Tracking Sparepart
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}





            {{-- @if (Auth::user()->role == 'admin')
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-9">Component</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('machine') || request()->is('location') || request()->is('shift') ? 'bg-primary text-white rounded-lg' : '' }}"
                        href="#" id="addComponentDropdown" role="button" data-bs-toggle="collapse"
                        data-bs-target="#addComponentMenu" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-plus text-dark text-sm"></i>
                        </div>
                        <span class="nav-link-text ms-1">Add Component</span>
                    </a>
                    <div class="collapse {{ request()->is('machine') || request()->is('location') || request()->is('shift') ? 'show' : '' }}"
                        id="addComponentMenu">
                        <ul class="nav flex-column ms-3 my-2">
                            <li class="nav-item">
                                <a class="nav-link p-2 d-flex align-items-center {{ request()->is('machine') ? 'active bg-light rounded' : '' }}"
                                    href="{{ route('machine') }}">
                                    <i class="fa-solid fa-warehouse me-2"></i> Mesin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-2 d-flex align-items-center {{ request()->is('location') ? 'active bg-light rounded' : '' }}"
                                    href="{{ route('location') }}">
                                    <i class="fa-solid fa-map-marker-alt me-2"></i> Lokasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-2 d-flex align-items-center {{ request()->is('shift') ? 'active bg-light rounded' : '' }}"
                                    href="{{ route('shift') }}">
                                    <i class="fa-solid fa-clock me-2"></i> Shift
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif --}}
        </ul>
    </div>
</aside>
