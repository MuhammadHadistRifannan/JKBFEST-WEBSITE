<div class="sidebar-gradient text-white d-flex flex-column position-relative min-vh-100 sidebar-container"
    style="flex-shrink: 0;">

    <img src="{{ asset('images/corner-dash.png') }}" alt="Corner Decoration"
        class="position-absolute top-0 end-0 w-100 sidebar-decoration">

    <div class="d-flex flex-column min-vh-100 p-4 position-relative sidebar-content" style="z-index: 2;">

        <div class="text-center mb-5 mt-2 pt-2 sidebar-logo">
            <img src="{{ asset('images/logo-dashboard.png') }}" alt="Logo" class="img-fluid logo-img">
        </div>

        {{-- Menu --}}
        <ul class="nav nav-pills flex-column mb-auto sidebar-menu gap-2">
            <li class="nav-item">
                <a href="/" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Home">
                    <img src="{{ asset('icons/dashboard/home.svg') }}" alt="Home" class="icon-svg flex-shrink-0">
                    <span class="sidebar-label ms-3">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    title="Home">
                    <img src="{{ asset('icons/dashboard/dashboard.svg') }}" alt="Dashboard"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label ms-3">Dashboard</span>
                </a>
            </li>
            @php
                $batasWaktu = \Carbon\Carbon::create(2026, 5, 2, 23, 59, 59);
                $isExpired = now()->greaterThan($batasWaktu);
            @endphp

            <li class="nav-item">
                @if (!$isExpired)
                    <a href="{{ route('teamPeserta') }}"
                        class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('teamPeserta') ? 'active' : '' }}"
                        title="Team">
                        <img src="{{ asset('icons/dashboard/team-nav-icon.svg') }}" alt="Team"
                            class="icon-svg flex-shrink-0">
                        <span class="sidebar-label ms-3">Team</span>
                    </a>
                @else
                        <a href="javascript:void(0)"
                            class="nav-link text-white-50 d-flex align-items-center sidebar-nav-link disabled"
                            style="opacity: 0.5; cursor: not-allowed; pointer-events: auto;" title="Batas waktu sudah berakhir"
                            onclick="event.preventDefault(); Swal.fire({
                        icon: 'warning',
                        title: 'Akses Terkunci',
                        text: 'Batas waktu pengisian Team telah berakhir.',
                        confirmButtonColor: '#5b1456'
                    });">

                            <img src="{{ asset('icons/dashboard/team-nav-icon.svg') }}" alt="Team"
                                class="icon-svg flex-shrink-0" style="opacity: 0.5;">

                            <span class="sidebar-label ms-3">Team</span>

                            <i class="bi bi-lock-fill ms-auto" style="font-size: 14px;"></i>
                        </a>
                @endif
            </li>
            <li class="nav-item">
                @if (auth()->user()->team && auth()->user()->team->status_team)
                    <a href="{{ route('uploadKarya') }}"
                        class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('uploadKarya') ? 'active' : '' }}"
                        title="Upload">
                        <img src="{{ asset('icons/dashboard/upload.svg') }}" alt="Upload" class="icon-svg flex-shrink-0">
                        <span class="sidebar-label ms-3">Upload</span>
                    </a>
                @else
                    <a href="javascript:void(0)"
                        class="nav-link text-white-50 d-flex align-items-center sidebar-nav-link disabled"
                        style="opacity: 0.5; cursor: not-allowed; pointer-events: auto;"
                        title="Pembayaran belum terverifikasi oleh admin"
                        onclick="event.preventDefault(); Swal.fire({icon: 'warning', title: 'Akses Terkunci', text: 'Pembayaran anda belum terverifikasi oleh admin. Silakan selesaikan pembayaran terlebih dahulu.', confirmButtonColor: '#5b1456'});">
                        <img src="{{ asset('icons/dashboard/upload.svg') }}" alt="Upload" class="icon-svg flex-shrink-0"
                            style="opacity: 0.5;">
                        <span class="sidebar-label ms-3">Upload</span>
                        <i class="bi bi-lock-fill ms-auto" style="font-size: 14px;"></i>
                    </a>
                @endif
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                    title="Contact">
                    <img src="{{ asset('icons/dashboard/contact.svg') }}" alt="Contact Person"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label ms-3">Contact Person</span>
                </a>
            </li>
        </ul>

        {{-- Sign Out --}}
        <div class="mt-auto mb-3 sidebar-signout pt-3">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit"
                    class="btn btn-signout w-100 py-2 px-3 d-flex align-items-center justify-content-center gap-2 shadow-sm sidebar-signout-btn"
                    title="Sign Out">
                    <img src="{{ asset('icons/dashboard/sign-out.svg') }}" alt="Sign Out"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label fw-bold">Sign Out</span>
                </button>
            </form>
        </div>

    </div>
</div>