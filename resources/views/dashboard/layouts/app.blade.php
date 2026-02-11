<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


    @yield('styles')
</head>

<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="d-flex" id="wrapper" style="height:100vh; overflow:hidden">

        {{-- Sidebar --}}
        <div id="sidebar-wrapper">
            @include('dashboard.partials.sidebar')
        </div>

        <div id="page-content-wrapper" class="d-flex flex-column flex-grow-1 w-100">
            {{-- Navbar --}}
            @include('dashboard.partials.navbar')

            {{-- Content --}}
            <main class="flex-grow-1 p-4" style="overflow-y: auto;">
                @yield('content')
            </main>
        </div>
    </div>



    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @yield('scripts')
</body>

</html>
