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

    /* Modal Styles */
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
        transition: all 0.3s ease;
    }
    
    .pdf-placeholder:hover {
        background-color: #fcfcfc;
        border-color: #D81E76;
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

    <h6 class="fw-bold text-custom-purple mb-4">Web Development Competition</h6>

    <div class="row g-4">
        
        <div class="col-12 col-md-3 col-xl-2">
            <div class="sidebar-pendaftar h-100">
                <div class="sidebar-pendaftar-title">Pendaftar</div>
                
                <div class="d-flex flex-column">
                    <a class="tab-box active filter-tab" data-filter="all">
                        <i class="bi bi-people-fill"></i>
                        <span>Semua ({{ $data->count() }})</span>
                    </a>

                    <a class="tab-box inactive filter-tab" data-filter="pending">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Pending ({{ $data->where('status_document', 'pending')->count() }})</span>
                    </a>
                    <a class="tab-box inactive filter-tab" data-filter="rejected">
                        <i class="bi bi-x-circle-fill"></i>
                        <span>Rejected ({{ $data->where('status_document', 'rejected')->count() }})</span>
                    </a>

                    <a class="tab-box inactive filter-tab" data-filter="approved">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Terverifikasi ({{ $data->where('status_document', 'approved')->count() }})</span>
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
                        @php $i = 1; @endphp
                        @foreach ($data as $team)
                        <tr class="table-row" data-status="{{ $team->status_document }}">
                            <td>{{ $i++ }}</td>
                            <td>{{ $team->team_name }}</td>
                            <td>{{ $team->created_at }}</td>
                            <td>
                                {{-- Jika status diverifikasi, ganti background jadi hijau (opsional) --}}
                                <div class="badge-status {{ $team->status_document == 'approved' ? 'bg-verified' : 'bg-pending' }} shadow-sm">
                                    <i class="bi {{ $team->status_document == 'approved' ? 'bi-check2-circle' : 'bi-three-dots' }} px-1 border border-1 border-white rounded-pill" style="font-size: 10px;"></i>
                                    {{ $team->status_document }}
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    {{-- TOMBOL EDIT YANG SUDAH DIBERI DATA ATTRIBUTES --}}
                                    <button class="icon-action icon-edit btn-edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDetailVerifikasi"
                                        data-id="{{ $team->team_id }}"
                                        data-name="{{ $team->team_name }}"
                                        data-inst="{{ $team->institution }}"
                                        data-ketua="{{ $team->name ?? 'Belum ada ketua' }}" 
                                        data-status="{{ $team->status_team ? 'Terverifikasi' : 'Pending' }}"
                                        data-pdf="{{ $team->document_path ? asset('storage/' . $team->document_path) : '#' }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    
                                    <button class="icon-action icon-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- MODAL DETAIL VERIFIKASI --}}
<div class="modal fade" id="modalDetailVerifikasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow">
            
            <div class="modal-header modal-header-gradient border-0 text-white p-3">
                <h6 class="modal-title fw-bold ms-3">Verifikasi Dokumen</h6>
                <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    
                    <div class="col-md-5">
                        {{-- KOTAK PDF SEKARANG BISA DIKLIK --}}
                        <a href="#" target="_blank" id="modal-pdf-link" class="pdf-placeholder text-decoration-none w-100">
                            <i class="bi bi-filetype-pdf" style="font-size: 4rem; color: #D81E76;"></i>
                            <span class="fw-bold mt-2" style="color: #D81E76; font-size: 1.2rem; letter-spacing: 2px;">Buka PDF</span>
                        </a>
                    </div>
                    
                    <div class="col-md-7 ps-md-4">
                        <h6 class="fw-bold text-dark mb-3">Detail Team</h6>
                        
                        <table class="table table-borderless table-modal-detail mb-4">
                            <tr>
                                <td class="text-muted" style="width: 120px;">Nama Team</td>
                                <td class="text-muted" style="width: 10px;">:</td>
                                <td class="text-dark fw-medium" id="modal-nama-team"></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Asal Instansi</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium" id="modal-instansi"></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Ketua Team</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium" id="modal-ketua"></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium" id="modal-status"></td>
                            </tr>
                        </table>
                        
                        <div class="d-flex gap-3 mt-4">
                            {{-- TOMBOL TOLAK --}}
                            <button class="btn btn-modal-outline w-50 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTolak">
                                Tolak
                            </button>
                            
                            {{-- FORM VERIFIKASI (SIAP DISAMBUNGKAN KE ROUTE) --}}
                            <form id="form-verifikasi" method="POST" action="{{ route('admin.updateStatus') }}" class="w-50">
                                @csrf
                                {{-- Jika ada method PUT/PATCH, tambahkan @method('PUT') --}}
                                <input type="hidden" name="team_id" id="hidden_team_id">
                                <input type="hidden" name="team_name" id="hidden_team_name">
                                <button type="submit" class="btn btn-modal-gradient w-100 py-2 fw-bold">
                                    Verifikasi
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow">
            
            <div class="modal-header border-0 text-white p-3" style="background-color: #E25A45;">
                <h6 class="modal-title fw-bold ms-3">Tolak Dokumen</h6>
                <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 p-md-5">
                <h6 class="fw-bold text-dark mb-1">Status Ditolak</h6>
                <small class="text-muted d-block mb-3">Berikan alasan ditolak agar team dapat memperbaikinya</small>
                
                {{-- FORM TOLAK (SIAP DISAMBUNGKAN KE ROUTE) --}}
                <form id="form-tolak" method="POST" action="{{ route('admin.rejectDocument') }}">
                    @csrf
                    {{-- Jika ada method PUT/PATCH, tambahkan @method('PUT') --}}
                    <input type="hidden" name="team_id" id="hidden_team_id_reject">
                    <input type="hidden" name="team_name" id="hidden_team_id_reject_name">
                    <textarea name="alasan_penolakan" class="form-control bg-light-custom border-0 rounded-3 mb-4 p-3" rows="5" placeholder="Tuliskan alasan penolakan..." required></textarea>
                    
                    <button type="submit" class="btn btn-modal-gradient w-100 py-2 fw-bold d-flex justify-content-center align-items-center gap-2">
                        <i class="bi bi-send-fill"></i> Kirim
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>

{{-- MODAL SUCCESS (BISA DIPAKAI SEBAGAI FLASH MESSAGE NANTINYA) --}}
<div class="modal fade" id="modalSuccess" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 p-4 p-md-5 text-center shadow">
            
            <div class="mb-4 mt-2">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: #E8F8F5;">
                    <i class="bi bi-check-circle-fill" style="font-size: 3.5rem; color: #00C851;"></i>
                </div>
            </div>
            
            <h5 class="fw-bold text-dark mb-2">Verifikasi Berhasil</h5>
            <p class="text-muted small mb-4 px-2">Team <span id="modal-success-team-name"></span> Berhasil di Verifikasi Admin</p>
            
            <button class="btn btn-modal-gradient w-100 py-2 fw-bold mt-2" data-bs-dismiss="modal">
                Kembali
            </button>
            
        </div>
    </div>
</div>

@include('sweetalert::alert')

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // --- 1. Logic Filter Tab Pendaftar ---
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

        // --- 2. Logic Passing Data ke Modal Edit ---
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Ambil data dari atribut HTML tombol yang sedang diklik
                const teamId     = this.getAttribute('data-id');
                const teamName   = this.getAttribute('data-name');
                const teamInst   = this.getAttribute('data-inst');
                const teamKetua  = this.getAttribute('data-ketua');
                const teamStatus = this.getAttribute('data-status');
                const teamPdf    = this.getAttribute('data-pdf');

                // Cetak data ke dalam teks Modal Detail
                document.getElementById('modal-nama-team').innerText = teamName;
                document.getElementById('modal-instansi').innerText = teamInst;
                document.getElementById('modal-ketua').innerText = teamKetua;
                document.getElementById('modal-status').innerText = teamStatus;

                // Update Link untuk Tombol Buka PDF
                const pdfLink = document.getElementById('modal-pdf-link');
                if (teamPdf !== '#') {
                    pdfLink.href = teamPdf;
                    pdfLink.removeAttribute('onclick');
                } else {
                    pdfLink.href = '#';
                    pdfLink.setAttribute('onclick', 'alert("Dokumen PDF belum diunggah!"); return false;');
                }

                // Update Action Form Verifikasi & Tolak sesuai dengan ID Team
                // (Sesuaikan URL route ini dengan route yang kamu buat di web.php)
                document.getElementById('hidden_team_id').value = teamId;
                document.getElementById('hidden_team_name').value = teamName;
                document.getElementById('hidden_team_id_reject').value = teamId;
                document.getElementById('hidden_team_id_reject_name').value = teamName;
                
                // Opsional: Untuk Modal Success
                const successName = document.getElementById('modal-success-team-name');
                if(successName) successName.innerText = teamName;
            });
        });

    });
</script>
@endsection