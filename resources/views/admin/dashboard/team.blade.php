@extends('admin.layouts.app')

@section('title', 'Manajemen Team')

@section('styles')
<style>
    .text-custom-purple { color: #4A154D !important; }

    /* Tombol Export */
    .btn-export {
        background-color: #12B347; /* Warna Hijau Excel */
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    
    .btn-export:hover {
        background-color: #0F993A;
        color: white;
    }

    /* Tabel Custom */
    .table-team-wrapper {
        background: #FFFFFF;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .table-team {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    /* Header Gradient */
    .table-team thead {
        background: linear-gradient(90deg, #D81E76 0%, #A41F7B 100%);
        color: white;
    }

    .table-team th {
        padding: 16px;
        font-weight: 600;
        font-size: 15px;
        text-align: center;
        border: none;
    }

    /* Body & Borders */
    .table-team td {
        padding: 24px 16px;
        vertical-align: top;
        border-bottom: 1px solid #F0F0F0;
    }

    /* Garis pembatas vertikal antar kolom (seperti gambar) */
    .table-team td:not(:last-child) {
        border-right: 1px solid #EAEAEA;
    }

    /* Badge Gradient Kategori */
    .category-badge {
        background: linear-gradient(90deg, #9C1A63 0%, #FF9933 100%);
        color: white;
        padding: 8px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* List Anggota */
    .member-list {
        margin: 0;
        padding-left: 20px;
        font-size: 14px;
        color: #333;
        line-height: 1.8;
    }
    
    .member-list li {
        margin-bottom: 4px;
    }
    
    /* Pagination Styling Custom (Opsional) */
    .pagination-wrapper nav svg {
        height: 20px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 mt-2 gap-3">
        <div>
            <h4 class="fw-bold text-custom-purple mb-1">Manajemen Team dan Peserta</h4>
            <p class="text-muted fw-normal mb-0" style="font-size: 14px;">Manajemen Verifikasi</p>
        </div>
        
        <div class="d-flex flex-column flex-sm-row gap-2 w-100 justify-content-md-end" style="max-width: 500px;">
            <form action="{{ url()->current() }}" method="GET" class="flex-grow-1">
                <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0" placeholder="Cari nama tim/instansi..." aria-label="Search">
                    <button class="btn btn-light border-0" type="submit">
                        <i class="bi bi-search text-muted"></i>
                    </button>
                </div>
            </form>

            <a href="{{ route('admin.export') }}" class="btn btn-export shadow-sm text-nowrap">
                <i class="bi bi-file-earmark-excel-fill fs-5"></i> Export Data
            </a>
        </div>
    </div>

    <div class="table-team-wrapper mb-4">
        <div class="table-responsive">
            <table class="table-team">
                <thead>
                    <tr>
                        <th style="width: 35%;">Nama Tim & Instansi</th>
                        <th style="width: 30%;">Kategori</th>
                        <th style="width: 35%;">Data Anggota</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $team)
                        <tr>
                            <td class="text-center align-middle">
                                <h6 class="fw-bold text-dark mb-1">{{ $team->team_name }}</h6>
                                <small class="text-muted">({{ $team->institution }})</small>
                            </td>
                            <td class="text-center align-middle">
                                <div class="category-badge">Web Development</div> 
                            </td>
                            <td>
                                <ol class="member-list">
                                    <li>{{ $team->user->name ?? 'Tidak ada data' }} (Ketua)</li>
                                    @foreach ($team->member as $member)
                                        <li>{{ $member->name }} - {{ $member->phone }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                Tidak ada data tim yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end pagination-wrapper">
        {{-- withQueryString() berguna agar parameter 'search' tidak hilang saat pindah halaman --}}
        {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection