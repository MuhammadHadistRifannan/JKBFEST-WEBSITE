@extends('admin.layouts.app')

@section('title', 'Manajemen Verifikasi')

@section('styles')
<style>
    /* Typography & Colors */
    .text-custom-purple { color: #4A154D !important; }
    .text-custom-pink { color: #D81E76 !important; }
    .text-dark-custom { color: #333333 !important; }

    /* Search & Filter Bar */
    .search-bar-wrapper {
        border: 1px solid #EAEAEA;
        border-radius: 50px;
        background: #FFFFFF;
        padding: 8px 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }
    
    .search-bar-wrapper input {
        border: none;
        box-shadow: none;
        outline: none;
        background: transparent;
        font-size: 14px;
    }
    
    .btn-filter {
        border: 1px solid #EAEAEA;
        border-radius: 50px;
        background: #FFFFFF;
        color: #333;
        font-weight: 500;
        font-size: 14px;
        padding: 10px 32px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        transition: background 0.2s;
    }
    
    .btn-filter:hover { background: #F8F9FA; }

    /* Sidebar Pendaftar (Tabs) */
    .sidebar-pendaftar {
        background: linear-gradient(180deg, #FF49C1 0%, #D81E76 100%);
        border-radius: 20px;
        padding: 24px 16px;
        box-shadow: 0 4px 12px rgba(216, 30, 118, 0.2);
    }

    .sidebar-pendaftar-title {
        color: #FFFFFF;
        font-weight: 600;
        font-size: 15px;
        text-align: center;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 12px;
        margin-bottom: 24px;
    }

    .tab-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px 10px;
        border-radius: 16px;
        margin-bottom: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .tab-box.active {
        background-color: #FFFFFF;
        color: #333333;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .tab-box.inactive {
        color: #FFFFFF;
        opacity: 0.9;
    }

    .tab-box.inactive:hover {
        opacity: 1;
        background-color: rgba(255,255,255,0.1);
    }

    .tab-box i { font-size: 24px; margin-bottom: 8px; }
    .tab-box.active i { color: #4A154D; }
    .tab-box span { font-size: 12px; font-weight: 600; }

    /* Custom Table (Capsule Rows) */
    .table-responsive { overflow-x: auto; }
    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .table-custom th {
        border: none;
        color: #333333;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        padding: 0 16px 8px 16px;
    }

    .table-custom th:nth-child(2) { text-align: left; }

    .table-custom tr {
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        transition: transform 0.2s;
    }

    .table-custom tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .table-custom td {
        background-color: #FFFFFF;
        padding: 16px 20px;
        vertical-align: middle;
        text-align: center;
        border-top: 1px solid #F4F4F4;
        border-bottom: 1px solid #F4F4F4;
        color: #333333;
        font-size: 13px;
        font-weight: 500;
    }

    .table-custom td:nth-child(2) { text-align: left; }

    .table-custom td:first-child {
        border-left: 1px solid #F4F4F4;
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
        font-weight: 600;
    }

    .table-custom td:last-child {
        border-right: 1px solid #F4F4F4;
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    /* Status Badges */
    .badge-status {
        padding: 8px 24px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: #FFFFFF;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 120px;
    }

    .bg-pending { background-color: #E25A45; }
    .bg-verified { background-color: #00C851; }

    /* Action Icons */
    .action-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    .icon-action {
        font-size: 18px;
        cursor: pointer;
        transition: opacity 0.2s;
        border: none;
        background: transparent;
        padding: 0;
    }

    .icon-action:hover { opacity: 0.7; }
    .icon-edit { color: #4A154D; }
    .icon-delete { color: #E25A45; }

    /* ========================================================
       STYLE UNTUK MODAL VERIFIKASI (BARU)
       ======================================================== */
    .modal-header-gradient {
        background: linear-gradient(135deg, #D81E76 0%, #4A154D 100%);
    }

    .pdf-placeholder {
        border: 2px solid #EAEAEA;
        border-radius: 16px;
        height: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .table-modal-detail td {
        padding: 8px 0;
        font-size: 14px;
    }

    .btn-modal-outline {
        border: 2px solid #D81E76;
        color: #D81E76;
        background: transparent;
        border-radius: 50px;
        transition: all 0.3s;
    }

    .btn-modal-outline:hover {
        background: #D81E76;
        color: #FFF;
    }

    .btn-modal-gradient {
        background: linear-gradient(135deg, #D81E76 0%, #4A154D 100%);
        color: #FFF;
        border: none;
        border-radius: 50px;
        transition: opacity 0.3s;
    }

    .btn-modal-gradient:hover {
        opacity: 0.9;
        color: #FFF;
    }

    .bg-light-custom {
        background-color: #F8F9FA !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
    
    <div class="mb-4">
        <h4 class="fw-bold text-custom-purple mb-4">Manajemen Verifikasi</h4>
        
        <div class="d-flex flex-column flex-md-row gap-3 align-items-center w-100">
            <div class="search-bar-wrapper flex-grow-1 w-100 d-flex align-items-center">
                <input type="text" class="w-100" placeholder="Search">
                <i class="bi bi-search text-muted fs-5"></i>
            </div>
            
            <button class="btn-filter flex-shrink-0 d-flex align-items-center gap-2">
                <i class="bi bi-funnel"></i> FILTER
            </button>
        </div>
    </div>

    <h6 class="fw-bold text-custom-purple mb-4">Web Developmen Competition</h6>

    <div class="row g-4">
        
        <div class="col-12 col-md-3 col-xl-2">
            <div class="sidebar-pendaftar h-100">
                <div class="sidebar-pendaftar-title">Pendaftar</div>
                
                <div class="d-flex flex-column">
                    <a class="tab-box active filter-tab" data-filter="all">
                        <i class="bi bi-people-fill"></i>
                        <span>Semua (100)</span>
                    </a>

                    <a class="tab-box inactive filter-tab" data-filter="pending">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Pending (100)</span>
                    </a>

                    <a class="tab-box inactive filter-tab" data-filter="verified">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Terverifikasi (100)</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-9 col-xl-10">
            <div class="table-responsive pb-2">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 8%;">No</th>
                            <th style="width: 27%;">Nama Team</th>
                            <th style="width: 25%;">Tanggal Submit</th>
                            <th style="width: 20%;">Status</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr class="table-row" data-status="pending">
                            <td>1</td>
                            <td>Langsung di Acc Saja</td>
                            <td>10 Januari 1998</td>
                            <td>
                                <div class="badge-status bg-pending shadow-sm">
                                    <i class="bi bi-three-dots px-1 border border-1 border-white rounded-pill" style="font-size: 10px;"></i>
                                    Pending
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <button class="icon-action icon-edit" data-bs-toggle="modal" data-bs-target="#modalDetailVerifikasi">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="icon-action icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row" data-status="verified">
                            <td>2</td>
                            <td>Langsung di Acc Saja</td>
                            <td>10 Januari 1998</td>
                            <td>
                                <div class="badge-status bg-verified shadow-sm">
                                    <i class="bi bi-shield-check" style="font-size: 14px;"></i>
                                    Terverifikasi
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <button class="icon-action icon-edit" data-bs-toggle="modal" data-bs-target="#modalDetailVerifikasi">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="icon-action icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="table-row" data-status="pending">
                            <td>3</td>
                            <td>Langsung di Acc Saja</td>
                            <td>10 Januari 1998</td>
                            <td>
                                <div class="badge-status bg-pending shadow-sm">
                                    <i class="bi bi-three-dots px-1 border border-1 border-white rounded-pill" style="font-size: 10px;"></i>
                                    Pending
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <button class="icon-action icon-edit" data-bs-toggle="modal" data-bs-target="#modalDetailVerifikasi">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="icon-action icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr class="table-row" data-status="pending">
                            <td>4</td>
                            <td>Langsung di Acc Saja</td>
                            <td>10 Januari 1998</td>
                            <td><div class="badge-status bg-pending shadow-sm"><i class="bi bi-three-dots px-1 border border-1 border-white rounded-pill" style="font-size: 10px;"></i> Pending</div></td>
                            <td>
                                <div class="action-icons">
                                    <button class="icon-action icon-edit" data-bs-toggle="modal" data-bs-target="#modalDetailVerifikasi"><i class="bi bi-pencil-square"></i></button>
                                    <button class="icon-action icon-delete"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalDetailVerifikasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow">
            
            <div class="modal-header modal-header-gradient border-0 text-white p-3">
                <h6 class="modal-title fw-bold ms-3">Verifikasi Pending</h6>
                <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    
                    <div class="col-md-5">
                        <div class="pdf-placeholder">
                            <i class="bi bi-filetype-pdf" style="font-size: 4rem; color: #D81E76;"></i>
                            <span class="fw-bold mt-2" style="color: #D81E76; font-size: 1.2rem; letter-spacing: 2px;">PDF</span>
                        </div>
                    </div>
                    
                    <div class="col-md-7 ps-md-4">
                        <h6 class="fw-bold text-dark mb-3">Detail Team</h6>
                        
                        <table class="table table-borderless table-modal-detail mb-4">
                            <tr>
                                <td class="text-muted" style="width: 120px;">Nama Team</td>
                                <td class="text-muted" style="width: 10px;">:</td>
                                <td class="text-dark fw-medium">Langsung di ACC Saja</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Asal Instansi</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium">Politeknik Negeri Cilacap</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Ketua Team</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium">Harry Potter</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium">Pending</td>
                            </tr>
                        </table>
                        
                        <div class="d-flex gap-3 mt-4">
                            <button class="btn btn-modal-outline w-50 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTolak">
                                Tolak
                            </button>
                            <button class="btn btn-modal-gradient w-50 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalSuccess">
                                Verifikasi
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow">
            
            <div class="modal-header border-0 text-white p-3" style="background-color: #E25A45;">
                <h6 class="modal-title fw-bold ms-3">Ditolak</h6>
                <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 p-md-5">
                <h6 class="fw-bold text-dark mb-1">Status Di Tolak</h6>
                <small class="text-muted d-block mb-3">Berikan alasan ditolak agar team dapat memperbaikinya</small>
                
                <textarea class="form-control bg-light-custom border-0 rounded-3 mb-4 p-3" rows="5" placeholder="Tuliskan alasan penolakan..."></textarea>
                
                <button class="btn btn-modal-gradient w-100 py-2 fw-bold d-flex justify-content-center align-items-center gap-2" data-bs-dismiss="modal">
                    <i class="bi bi-send-fill"></i> Kirim
                </button>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalSuccess" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 p-4 p-md-5 text-center shadow">
            
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: #E8F8F5;">
                    <i class="bi bi-check-circle-fill" style="font-size: 3.5rem; color: #00C851;"></i>
                </div>
            </div>
            
            <h5 class="fw-bold text-dark mb-2">Verifikasi Berhasil</h5>
            <p class="text-muted small mb-4 px-2">Team Langsung di Acc Saja Berhasil di Verifikasi Admin</p>
            
            <button class="btn btn-modal-gradient w-100 py-2 fw-bold mt-2" data-bs-dismiss="modal">
                Kembali
            </button>
            
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // --- Logic Filter Tab Pendaftar ---
        const tabs = document.querySelectorAll('.filter-tab');
        const rows = document.querySelectorAll('.table-row');

        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.classList.add('inactive');
                });
                
                this.classList.remove('inactive');
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                let count = 1;
                rows.forEach(row => {
                    if (filterValue === 'all' || row.getAttribute('data-status') === filterValue) {
                        row.style.display = '';
                        row.querySelector('td:first-child').innerText = count;
                        count++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection