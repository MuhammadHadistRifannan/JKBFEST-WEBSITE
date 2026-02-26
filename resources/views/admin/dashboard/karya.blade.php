@extends('admin.layouts.app')

@section('title', 'Manajemen Karya')

@section('styles')
<style>
    .text-custom-purple { color: #4A154D !important; }

    .btn-download-zip {
        background-color: #FF49C1;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-download-zip:hover {
        background-color: #D81E76;
        color: white;
    }

    .btn-export {
        background-color: #00C851;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-export:hover {
        background-color: #009E3E;
        color: white;
    }

    .table-karya-wrapper {
        background: #FFFFFF;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .table-karya {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table-karya thead {
        background: linear-gradient(90deg, #D81E76 0%, #A41F7B 100%);
        color: white;
    }

    .table-karya th {
        padding: 16px;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
        border: none;
    }

    .table-karya th:first-child {
        text-align: left;
        padding-left: 24px;
    }

    .table-karya td {
        padding: 20px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #F0F0F0;
        text-align: center;
        font-size: 13px;
        color: #333;
    }

    .table-karya td:not(:last-child) {
        border-right: 1px solid #EAEAEA;
    }

    .table-karya td:first-child {
        text-align: left;
        padding-left: 24px;
    }

    .drive-link {
        color: #0d6efd;
        text-decoration: underline;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .drive-link:hover {
        color: #0a58ca;
    }

    .badge-status {
        padding: 6px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 12px;
        color: white;
        display: inline-block;
    }

    .bg-tepat-waktu { background-color: #00C851; }
    .bg-terlambat { background-color: #E74C3C; }

    .btn-nilai {
        background-color: #4A154D;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 6px 28px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
    }

    .btn-nilai:hover {
        background-color: #2D0B2F;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 mt-2 gap-3">
        <div>
            <h4 class="fw-bold text-custom-purple mb-1">Manajemen Karya</h4>
            <p class="text-muted fw-normal mb-0" style="font-size: 14px;">Manajemen Verifikasi</p>
        </div>
        
        <div class="d-flex gap-3">
            <button class="btn btn-download-zip shadow-sm">
                <i class="bi bi-download fs-5"></i> Unduh Semua (.zip)
            </button>
            <a href="{{ route('admin.exportKarya') }}" class="btn btn-export shadow-sm">
                <i class="bi bi-file-earmark-excel-fill fs-5"></i> Export Data (Excel/CSV)
            </a>
        </div>
    </div>

    <h5 class="fw-bold text-dark mb-3">Rekapitulasi Pengumpulan Karya</h5>

    <div class="table-karya-wrapper">
        <div class="table-responsive">
            <table class="table-karya">
                <thead>
                    <tr>
                        <th style="width: 25%;">Tim</th>
                        <th style="width: 20%;">Lihat Karya</th>
                        <th style="width: 25%;">Waktu Submit</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $team)
                    
                    <tr>
                        <td>
                            <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">{{ $team->team_name }}</h6>
                            <small class="text-muted" style="font-size: 11px;">Kategori : Web Development</small>
                        </td>
                        <td>
                            <a href="{{ $team->link_karya }}" class="drive-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                  <path d="M15.96 7.328c-.14-.236-.341-.429-.586-.554l-5.6-3.136a1.5 1.5 0 0 0-1.549 0l-5.6 3.136c-.245.125-.446.318-.586.554L.19 10.665c-.14.236-.211.5-.211.77 0 .269.071.534.211.77l1.85 3.134c.14.236.341.429.586.554.245.125.52.19.805.19h11.12c.285 0 .56-.065.805-.19.245-.125.446-.318.586-.554l1.85-3.134c.14-.236.211-.5.211-.77 0-.269-.071-.534-.211-.77l-1.849-3.337zM4.328 13.918L1.6 8.355l4.8-2.688 2.728 5.563-4.8 2.688zm5.553 0L7.153 8.355l4.8-2.688 2.728 5.563-4.8 2.688z"/>
                                </svg>
                                Link Google Drive
                            </a>
                        </td>
                        <td class="fw-medium">{{ $team->waktu_submit }}</td>
                        <td>
                            <div class="badge-status bg-tepat-waktu">Tepat Waktu</div>
                        </td>
                        <td>
                            <button class="btn-nilai">Nilai</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection