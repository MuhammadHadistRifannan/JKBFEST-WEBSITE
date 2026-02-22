<style>
    /* Styling untuk animasi search bar */
    .navbar-search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: 50px;
        height: 40px;
        width: 40px;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }
    
    /* State saat kolom pencarian terbuka */
    .navbar-search-wrapper.open {
        width: 250px;
        background-color: #FFFFFF;
        border-color: #333333;
    }

    .navbar-search-btn {
        background: transparent;
        border: none;
        outline: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        cursor: pointer;
        flex-shrink: 0;
        color: #333333;
    }

    .navbar-search-input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        height: 100%;
        opacity: 0;
        padding-right: 15px;
        font-size: 14px;
        transition: opacity 0.3s ease-in-out;
        pointer-events: none; /* Disable saat disembunyikan */
    }

    .navbar-search-input::placeholder {
        color: #6c757d;
        font-weight: 400;
    }

    /* Memunculkan input text saat state open */
    .navbar-search-wrapper.open .navbar-search-input {
        opacity: 1;
        pointer-events: auto;
    }
</style>

<nav class="navbar navbar-light bg-white py-3 px-4 shadow-sm" style="z-index: 10;">
    <div class="container-fluid px-0 d-flex justify-content-between align-items-center">
        
        <button class="navbar-toggler border-0 p-0" type="button" id="sidebarToggle">
            <img src="{{ asset('icons/dashboard/toggler.svg') }}" alt="Menu Icon" width="24" height="24">
        </button>

        <div class="d-flex align-items-center gap-3 gap-md-4">
            
            {{-- Wrapper Search Animasi Buka Tutup --}}
            <div class="navbar-search-wrapper" id="navbarSearch">
                <button class="navbar-search-btn" id="searchBtnToggle">
                    <i class="bi bi-search fs-5"></i>
                </button>
                <input type="text" class="navbar-search-input" id="searchInput" placeholder="Search">
            </div>

            <div class="d-flex align-items-center gap-2" style="cursor: pointer;">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Profile" class="rounded-circle object-fit-cover" style="width: 40px; height: 40px;">
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="width: 12px; height: 12px;">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </div>
                
                <div class="d-none d-sm-flex flex-column align-items-start ms-1">
                    <span class="fw-bold text-dark mb-0" style="font-size: 14px; line-height: 1;">Admin</span>
                    <span class="text-muted fw-light" style="font-size: 12px; margin-top: 2px;">Administrator</span>
                </div>
                
                <i class="bi bi-caret-down-fill text-dark ms-2" style="font-size: 12px;"></i>
            </div>
            
        </div>
    </div>
</nav>

{{-- Script Khusus untuk Animasi Buka Tutup Search --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchContainer = document.getElementById('navbarSearch');
        const searchBtn = document.getElementById('searchBtnToggle');
        const searchInput = document.getElementById('searchInput');

        // Event saat tombol icon search diklik
        searchBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event klik bocor ke dokumen
            searchContainer.classList.toggle('open');
            
            // Jika container terbuka, langsung fokuskan kursor ke input text
            if(searchContainer.classList.contains('open')) {
                searchInput.focus();
            }
        });

        // Event agar search tertutup otomatis jika kita klik area kosong di luar kotak pencarian
        document.addEventListener('click', function(event) {
            if (!searchContainer.contains(event.target)) {
                searchContainer.classList.remove('open');
            }
        });
    });
</script>