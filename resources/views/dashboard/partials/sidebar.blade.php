<div class="sidebar-gradient text-white d-flex flex-column position-relative h-100 sidebar-container"
    style="flex-shrink: 0;">

    <img src="{{ asset('images/corner-dash.png') }}" alt="Corner Decoration"
        class="position-absolute top-0 end-0 w-100 sidebar-decoration">

    <div class="d-flex flex-column h-100 p-4 position-relative sidebar-content" style="z-index: 2;">

        <div class="text-center mb-5 mt-2 pt-2 sidebar-logo">
            <img src="{{ asset('images/logo-dashboard.png') }}" alt="Logo" class="img-fluid logo-img">
        </div>

        {{-- Menu --}}
        <ul class="nav nav-pills flex-column mb-auto sidebar-menu gap-1">
            <li class="nav-item">
                <a href="#" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Home">
                    <img src="{{ asset('icons/dashboard/home.svg') }}" alt="Home" class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    title="Home">
                    <img src="{{ asset('icons/dashboard/dashboard.svg') }}" alt="Dashboard"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('teamPeserta') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('teamPeserta') ? 'active' : '' }}"
                    title="Team">
                    <img src="{{ asset('icons/dashboard/team-nav-icon.svg') }}" alt="Team"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('uploadKarya') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('uploadKarya') ? 'active' : '' }}"
                    title="Upload">
                    <img src="{{ asset('icons/dashboard/upload.svg') }}" alt="Upload" class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Upload</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}"
                    class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                    title="Contact">
                    <img src="{{ asset('icons/dashboard/contact.svg') }}" alt="Contact Person"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Contact Person</span>
                </a>
            </li>
        </ul>

        {{-- Sign Out --}}
        <div class="mt-auto mb-3 sidebar-signout">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit"
                    class="btn btn-signout w-100 py-2 ps-4 d-flex align-items-center justify-content-start gap-2 shadow sidebar-signout-btn"
                    title="Sign Out">
                    <img src="{{ asset('icons/dashboard/sign-out.svg') }}" alt="Sign Out"
                        class="icon-svg flex-shrink-0">
                    <span class="sidebar-label">Sign Out</span>
                </button>
            </form>
        </div>

    </div>
</div>