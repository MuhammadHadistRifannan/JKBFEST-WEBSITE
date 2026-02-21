@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Header --}}
    <div class="hero-gradient p-4 mb-4 text-white d-flex align-items-center justify-content-between position-relative">
        <div class="z-3">
            <h2 class="fw-semibold mb-1 mt-3">Selamat Datang, {{ auth()->user()->name }}!!</h2>
            <p class="mb-3">Bersiaplah untuk berinovasi dan tunjukkan potensi terbaikmu di JKB Fest</p>
        </div>
        <div class="corner-dash position-absolute top-0 end-0">
            <img src="{{ asset('images/corner-top-dash.png') }}" alt="corner-top-dash">
        </div>
    </div>

    {{-- Detail User --}}
    <div class="card mb-4 p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-custom-purple fw-bold d-flex align-items-center gap-2">
                <img src="{{ asset('icons/dashboard/user.svg') }}" alt="User Icon" class="icon-svg">
                Detail User
            </h5>
            <button class="btn btn-outline-primary btn-sm px-3 rounded-3">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="bg-soft-pink p-3 d-flex align-items-center">
                    <img src="{{ asset('icons/dashboard/user.svg') }}" alt="User Icon" class="icon-svg me-3">
                    <div>
                        <small class="fw-light d-block">Nama Lengkap</small>
                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-soft-pink p-3 d-flex align-items-center">
                    <img src="{{ asset('icons/dashboard/team-black.svg') }}" alt="Team Icon" class="icon-svg me-3">
                    <div>
                        <small class="fw-light d-block ">Status Team</small>
                        @if (auth()->user()->team)
                            <span class="fw-bold">Terdaftar</span>
                        @else
                            <span class="fw-bold">Belum Mendaftar</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-soft-pink p-3 d-flex align-items-center">
                    <img src="{{ asset('icons/dashboard/telephone.svg') }}" alt="Telephone Icon" class="icon-svg me-3">
                    <div>
                        <small class="fw-light d-block">No Telepon</small>
                        <span class="fw-bold">{{ auth()->user()->no_telp }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-soft-pink p-3 d-flex align-items-center">
                    <img src="{{ asset('icons/dashboard/email.svg') }}" alt="Email Icon" class="icon-svg me-3">
                    <div>
                        <small class="fw-light d-block">Email</small>
                        <span class="fw-bold text-break">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informasi Team --}}
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card p-4 rounded-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-custom-purple fw-bold d-flex align-items-center gap-2 mb-0">
                        <img src="{{ asset('icons/dashboard/people.svg') }}" alt="Team Icon" class="icon-svg me-2">
                        Informasi Team
                    </h5>

                    {{-- Badge status --}}
                    @if (auth()->user()->team)
                        @if (auth()->user()->team->status == 'verified')
                            <span class="badge rounded-pill px-3 py-2" style="background-color: #00C851">
                                <img src="{{ asset('icons/dashboard/shield-icon.svg') }}" alt="shield-icon" class="me-1">
                                Terverifikasi
                            </span>
                        @else
                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                <img src="{{ asset('icons/dashboard/pending-icon.svg') }}" alt="pending-icon" class="me-1">
                                Pending
                            </span>
                        @endif
                    @endif {{-- Ini @endif yang sebelumnya kurang --}}
                </div>

                @if (!auth()->user()->team)
                    {{-- JIKA BELUM MENDAFTAR TEAM --}}
                    <div class="bg-soft-pink p-4 rounded-4 text-center h-100 d-flex flex-column justify-content-center">
                        <p class="mb-4">
                            Kamu Belum Mendaftarkan Team kamu. Untuk mendaftar, <br>
                            silahkan isi form Pendaftaran.
                        </p>

                        <a href="{{ route('addTeam') }}" class="btn btn-custom w-100 rounded-3 fw-semibold py-2">
                            Daftarkan Team
                        </a>
                    </div>
                @else
                    {{-- JIKA SUDAH MENDAFTAR TEAM --}}
                    <div class="bg-soft-pink p-4 rounded-4 mb-2">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0" style="--bs-table-bg: transparent;">
                                <tbody>
                                    <tr>
                                        <td class="fw-light ps-0 py-1" style="width: 160px;">Nama Team</td>
                                        <td class="fw-light py-1">: Hallo mo</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-light ps-0 py-1">Asal Institusi</td>
                                        <td class="fw-light py-1">: PNC Ale</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-light ps-0 py-1">Ketua Team</td>
                                        <td class="fw-light py-1">: Harry Potter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="border-secondary border-3 opacity-25 mt-4">
                @endif
            </div>
        </div>

        {{-- Guidebook --}}
        <div class="col-lg-5">
            <div class="card h-100 p-4 rounded-4">
                <h5 class="text-custom-purple fw-bold mb-3 d-flex align-items-center gap-2">
                    <img src="{{ asset('icons/dashboard/book.svg') }}" alt="Guidebook" class="icon-svg me-2">
                    Guidebook
                </h5>

                <div class="bg-soft-pink p-3 rounded-3 mb-4">
                    <p class="mb-0 fw-light">
                        Panduan lengkap acara lomba Web JKB FEST 2026 dapat anda unduh di sini
                    </p>
                </div>

                <div class="d-flex flex-column gap-3">
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-3">
                        <img src="{{ asset('icons/dashboard/s&k.svg') }}" alt="Syarat Icon" class="icon-svg">
                        <span class="fw-light">Syarat dan Ketentuan</span>
                    </a>
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-3">
                        <img src="{{ asset('icons/dashboard/timeline.svg') }}" alt="Timeline Icon" class="icon-svg">
                        <span class="fw-light">Timeline Lomba</span>
                    </a>
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-3">
                        <img src="{{ asset('icons/dashboard/sistem-nilai.svg') }}" alt="Penilaian Icon" class="icon-svg">
                        <span class="fw-light">Sistem Penilaian</span>
                    </a>
                    <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-3">
                        <img src="{{ asset('icons/dashboard/ketentuan-pengumpulan.svg') }}" alt="Ketentuan Pengumpulan Icon" class="icon-svg">
                        <span class="fw-light">Ketentuan Pengumpulan</span>
                    </a>
                    <a href="#" class="btn btn-custom rounded-3 fw-bold py-2">
                        Download Guidebook
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection