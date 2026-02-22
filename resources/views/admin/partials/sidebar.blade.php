<div class="sidebar-gradient text-white d-flex flex-column position-relative h-100 sidebar-container" style="flex-shrink: 0;">
    <img src="{{ asset('images/corner-dash.png') }}" alt="Corner Decoration" class="position-absolute top-0 end-0 w-100 sidebar-decoration">
    <div class="d-flex flex-column h-100 p-4 position-relative sidebar-content" style="z-index: 2;">
        
        <div class="text-center mb-5 mt-2 pt-2 sidebar-logo">
            <img src="{{ asset('images/logo-dashboard.png') }}" alt="Logo" class="img-fluid logo-img">
        </div>

        <ul class="nav nav-pills flex-column mb-auto sidebar-menu gap-2">
            <li class="nav-item">
                <a href="#" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Home">
                    <i class="bi bi-house-door-fill fs-5 flex-shrink-0" style="width: 24px; text-align: center;"></i>
                    <span class="sidebar-label ms-3">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white d-flex align-items-center sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                    <i class="bi bi-grid-1x2-fill fs-5 flex-shrink-0" style="width: 24px; text-align: center;"></i>
                    <span class="sidebar-label ms-3">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.verifikasi') }}" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Verifikasi">
                    <i class="bi bi-clipboard-check-fill fs-5 flex-shrink-0" style="width: 24px; text-align: center;"></i>
                    <span class="sidebar-label ms-3">Verifikasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.team') }}" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Team">
                    <i class="bi bi-people-fill fs-5 flex-shrink-0" style="width: 24px; text-align: center;"></i>
                    <span class="sidebar-label ms-3">Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.karya') }}" class="nav-link text-white d-flex align-items-center sidebar-nav-link" title="Karya">
                    <i class="bi bi-file-earmark-text-fill fs-5 flex-shrink-0" style="width: 24px; text-align: center;"></i>
                    <span class="sidebar-label ms-3">Karya</span>
                </a>
            </li>
        </ul>

        <div class="mt-auto mb-3 sidebar-signout">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="btn w-100 py-2 px-3 d-flex align-items-center justify-content-center gap-2 shadow-sm sidebar-signout-btn" style="background-color: #FF3B3B; color: white; border-radius: 12px; border: none;" title="Sign Out">
                    <i class="bi bi-box-arrow-right fs-5 flex-shrink-0"></i>
                    <span class="sidebar-label fw-bold">Sign Out</span>
                </button>
            </form>
        </div>

    </div>
</div>