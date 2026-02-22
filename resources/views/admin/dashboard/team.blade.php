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
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 mt-2 gap-3">
        <div>
            <h4 class="fw-bold text-custom-purple mb-1">Manajemen Team dan Peserta</h4>
            <p class="text-muted fw-normal mb-0" style="font-size: 14px;">Manajemen Verifikasi</p>
        </div>
        
        <button class="btn btn-export shadow-sm">
            <i class="bi bi-file-earmark-excel-fill fs-5"></i> Export Data (Excel/CSV)
        </button>
    </div>

    <div class="table-team-wrapper">
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
                    <tr>
                        <td class="text-center align-middle">
                            <h6 class="fw-bold text-dark mb-1">Langsung di ACC Saja</h6>
                            <small class="text-muted">(Politeknik Negeri Cilacap)</small>
                        </td>
                        <td class="text-center align-middle">
                            <div class="category-badge">Web Development</div>
                        </td>
                        <td>
                            <ol class="member-list">
                                <li>Lamine Yamal (Ketua)</li>
                                <li>Lewandowski</li>
                                <li>Raphinha</li>
                            </ol>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center align-middle">
                            <h6 class="fw-bold text-dark mb-1">Langsung di ACC Saja</h6>
                            <small class="text-muted">(Politeknik Negeri Cilacap)</small>
                        </td>
                        <td class="text-center align-middle">
                            <div class="category-badge">Web Development</div>
                        </td>
                        <td>
                            <ol class="member-list">
                                <li>Lamine Yamal (Ketua)</li>
                                <li>Lewandowski</li>
                                <li>Raphinha</li>
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection