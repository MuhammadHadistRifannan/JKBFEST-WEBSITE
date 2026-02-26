@extends('dashboard.layouts.app')

@section('title', 'Team Peserta')

@section('content')

    {{-- CSS TAMBAHAN UNTUK GRADIENT STROKE KETUA --}}
    <style>
        .border-gradient-ketua {
            position: relative;
        }
        .border-gradient-ketua::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 0.5rem; /* Menyesuaikan dengan class rounded-3 Bootstrap */
            padding: 2.5px; /* Ketebalan stroke/garis luar */
            background: linear-gradient(to right, #B33279, #F7941D); /* Warna gradient dari Pink/Ungu ke Orange */
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
    </style>

    @php
        // Deadline Pendaftaran
        $deadline = date_create('2026-02-26');
        $range = now()->diffInDays($deadline);

        $day_remain = round($range);

        $isAlmostClosed = $day_remain <= 2;
    @endphp

    {{-- Cek apakah user BELUM punya team --}}
    @if (!auth()->user()->team)
        
        {{-- HAPUS TITIK KOMA DI SINI AGAR TIDAK MUNCUL DI LAYAR --}}
        @include('dashboard.dashboard.addTeam')

    @else
        {{-- JIKA SUDAH PUNYA TEAM, TAMPILKAN DASHBOARD DI BAWAH INI --}}

        {{-- HEADER CARD --}}
        <div class="hero-gradient card bg-gradient-header text-white p-4 mb-4 rounded-4 border-0 shadow-sm d-flex flex-row align-items-center justify-content-between position-relative overflow-hidden">
            <div class="ms-3 position-relative z-1">
                <div class="d-flex align-items-center gap-2">
                    <small class="fw-light">Web Development</small>

                    @if (auth()->user()->team)
                        @if (auth()->user()->team->document?->status_document === 'approved')
                            <span class="badge rounded-pill px-4 py-1 ms-0 ms-lg-3 d-inline-flex align-items-center justify-content-center" style="background-color: #00C851">
                                <img src="{{ asset('icons/dashboard/shield-icon.svg') }}" alt="shield-icon" class="me-1">
                                Terverifikasi
                            </span>
                        {{-- GUNAKAN NULLSAFE OPERATOR (?->) DI SINI --}}
                        @elseif (auth()->user()->team->document?->status_document === 'pending')
                            <span class="badge bg-danger rounded-pill px-4 py-1 ms-0 ms-lg-3 d-inline-flex align-items-center justify-content-center">
                                <img src="{{ asset('icons/dashboard/pending-icon.svg') }}" alt="pending-icon" class="me-1">
                                Pending
                            </span>
                        @elseif (auth()->user()->team->document?->status_document === 'rejected')
                            <span class="badge bg-danger rounded-pill px-4 py-1 ms-0 ms-lg-3 d-inline-flex align-items-center justify-content-center">
                                <img src="{{ asset('icons/dashboard/pending-icon.svg') }}" alt="pending-icon" class="me-1">
                                Ditolak
                            </span>
                        @endif
                    @endif
                </div>

                {{-- PASTIKAN MENGGUNAKAN team_name SESUAI DATABASE --}}
                <h4 class="fw-bold mb-0 mt-0 mt-lg-2">{{ auth()->user()->team->team_name ?? 'Nama Team' }}</h4>
            </div>

            <div class="rounded-circle me-3 d-flex align-items-center justify-content-center position-relative z-3">
                <img src="{{ asset('icons/dashboard/people-icon-header.svg') }}" alt="">
            </div>

            <div class="corner-dash position-absolute top-0 end-0">
                <img src="{{ asset('images/corner-top-dash.png') }}" alt="corner-top-dash">
            </div>
        </div>

        <div class="row g-4">
            {{-- Informasi Team & Member --}}
            <div class="col-lg-8">
                <div class="card p-4 rounded-4 shadow-sm h-100">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-custom-purple fw-bold d-flex align-items-center gap-2 mb-0 text-dark">
                            <img src="{{ asset('icons/dashboard/people.svg') }}" alt="Team Icon" class="icon-svg"> Informasi Team
                        </h5>
                    </div>

                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <div class="bg-soft-pink p-3 rounded-3">
                                <small class="text-muted d-block mb-1"><i class="bi bi-building me-1"></i> Asal Institusi</small>
                                <span class="fw-medium text-dark">{{ auth()->user()->team->institution ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-soft-pink p-3 rounded-3">
                                <small class="text-muted d-block mb-1"><i class="bi bi-person-badge me-1"></i> Nama Pembina</small>
                                <span class="fw-medium text-dark">{{ auth()->user()->team->advisor_name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-medium text-dark mb-3">Team Member</h5>

                    <div class="d-flex flex-column gap-3">
                        
                        {{-- DIV KETUA TIM: Hapus border standard, pakai border-gradient-ketua --}}
                        <div class="bg-soft-pink border-gradient-ketua rounded-3 p-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-medium mb-1">{{ auth()->user()->name ?? '-' }}</h6>
                                <small class="text-muted">{{ auth()->user()->no_telp ?? '-' }}</small>
                            </div>
                            <span class="badge-ketua">
                                <img src="{{ asset('icons/dashboard/badge-ketua.svg') }}" class="img-fluid" alt="" />
                            </span>
                        </div>
                        
                        {{-- ANGGOTA TIM LAINNYA: Tetap pakai border standard --}}
                        @if (auth()->user()->team && auth()->user()->team->member)
                            @foreach (auth()->user()->team->member as $member)
                                <div class="border border-secondary rounded-3 p-3">
                                    <h6 class="fw-medium mb-1">{{ $member->name }}</h6>
                                    <small class="text-muted">{{ $member->phone ?? $member->no_telp }}</small>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

            {{-- Pembayaran & Dokumen --}}
            <div class="col-lg-4">
                <div class="card p-4 rounded-4 shadow-sm mb-4">
                    <h5 class="text-custom-purple fw-bold d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('icons/dashboard/payment-icon.svg') }}" alt="Payment Icon" /> Pembayaran
                    </h5>

                    @if (auth()->user()->team && auth()->user()->team->status_team)
                        <div class="rounded-3 p-4 d-flex flex-column align-items-center text-center gap-2" style="background-color: #F0FDF4; border: 1px solid #267228;">
                            <img src="{{ asset('icons/dashboard/mini-check-icon.svg') }}" alt="check-icon-green" />
                            <h5 class="fw-semibold mb-1" style="color: #267228;">Pembayaran Terverifikasi</h5>
                            <small class="fw-light d-block" style="color: #267228;">Terima kasih atas partisipasi Anda, dan selamat mengikuti lomba.</small>
                        </div>
                    @else
                        @if (auth()->user()->team && !auth()->user()->team->status_team && !auth()->user()->team->document?->document_path && $isAlmostClosed)
                            <div class="rounded-3 p-3 mb-3" style="background:#FFE3E0; border:1px solid #EB5243;">
                                <small class="fw-light alert-custom">
                                    Segera lakukan pembayaran dan unggah bukti pembayaran sebelum batas waktu pendaftaran ditutup.
                                </small>
                            </div>
                        @endif

                        <div class="text-center mb-3">
                            <span class="fw-medium">Biaya Pendaftaran Rp 70.000,00</span>
                        </div>

                        @if (auth()->user()->team && auth()->user()->team->document?->has_payed)
                            <button type="button" class="btn btn-custom-green w-100 py-2 fw-semibold rounded-3 shadow-sm">
                                <img src="{{ asset('icons/dashboard/pending-icon.svg') }}" alt="pending-icon"> Pending
                            </button>
                        @else
                            <button type="button" class="btn btn-custom-green w-100 py-2 fw-semibold rounded-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                Bayar
                            </button>
                        @endif
                    @endif
                </div>

                <div class="card p-4 rounded-4 shadow-sm ">
                    <h5 class="fw-bold d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('icons/dashboard/doc-icon.svg') }}" alt="Document Icon" /> Dokumen Team
                    </h5>
                    <p class="fw-light small mb-3">
                        Upload dokumen sesuai perintah yang ada di Guidebook untuk memverifikasi Team.
                    </p>

                    @if (auth()->user()->team && auth()->user()->team->document?->document_path)
                        <div class="bg-soft-pink border border-secondary p-3 rounded-3 d-flex align-items-center gap-3">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('icons/dashboard/pdf-icons.svg') }}" alt="PDF Icon">
                            </div>
                            <div class="overflow-hidden">
                                <h6 class="mb-0 fw-normal">
                                    {{ auth()->user()->team->team_name ?? 'Team' }}_Web jkb fest.pdf
                                </h6>
                            </div>
                        </div>
                    @else
                        @if (auth()->user()->team && $isAlmostClosed)
                            <div class="rounded-3 p-3 mb-3" style="background:#FFE3E0; border:1px solid #EB5243;">
                                <small class="alert-custom d-block fw-light mb-2 ">
                                    Peringatan: Waktu pendaftaran lomba hampir berakhir.
                                </small>
                                <small class="alert-custom d-block fw-light ">
                                    Segera lengkapi pendaftaran dan unggah berkas yang diperlukan sebelum batas waktu ditutup.
                                </small>
                            </div>
                        @endif 

                        <form action="{{ route('uploadDocument') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="document_file" id="documentInput" accept="application/pdf" hidden onchange="this.form.submit()">

                            <div class="w-100 px-5 py-4 d-flex flex-column align-items-center text-center"
                                onclick="document.getElementById('documentInput').click()"
                                style="border: 2px dashed #ccc; border-radius: 10px; cursor: pointer;">
                                <div class="mb-2 text-custom-purple">
                                    <img src="{{ asset('icons/dashboard/upload-icon.svg') }}" alt="Upload Icon" />
                                </div>
                                <span class="fw-bold mb-1" style="color: #FF49C1;">Upload Berkas</span>
                                <small class="text-muted">PDF Maks 20 MB</small>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Modal Pembayaran --}}
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 p-2">
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="modal-title fw-semibold" id="paymentModalLabel">Pembayaran Pendaftaran</h5>
                            <p class="fw-light small mb-0">Silahkan melakukan pendaftaran untuk mengikuti lomba ini</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body gradient-border-wrapper m-3">
                        <div class="gradient-border-content px-4 pb-4">
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3">
                                <div class="bg-white p-2 rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <img src="{{ asset('icons/dashboard/team-modal.svg') }}" alt="Team Modal Icon" />
                                </div>
                                <div>
                                    <small class="fw-light d-block" style="font-size: 11px;">Nama Team :</small>
                                    <span class="fw-bold text-custom-purple">{{ auth()->user()->team->team_name ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="bg-pink p-3 rounded-3 mb-4">
                                <div class="row g-2 align-items-center mb-1">
                                    <div class="col-5"><small class="fw-light">Lomba</small></div>
                                    <div class="col-1 text-center"><small class="fw-light">:</small></div>
                                    <div class="col-6"><small class="fw-light">Web Development</small></div>
                                </div>
                                <div class="row g-2 align-items-center">
                                    <div class="col-5"><small class="fw-light">Biaya Pendaftaran</small></div>
                                    <div class="col-1 text-center"><small class="fw-light">:</small></div>
                                    <div class="col-6"><small class="fw-light">RP 70.000</small></div>
                                </div>
                            </div>

                            <p class="fw-semibold mb-2">Metode Pembayaran</p>

                            <div class="row g-4 mb-4">
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 position-relative h-100 bg-pink">
                                        <img src="{{ asset('icons/dashboard/dana-icon.svg') }}" class="mb-2" alt="DANA">
                                        <p class="fw-light mb-0" style="font-size: 10px;">No Dana</p>
                                        <p class="mb-0 small ">081327280676</p>
                                        <small class="fw-light d-block mb-2" style="font-size: 10px;">a.n Ahmed Amirul Azmi</small>
                                        <button class="btn btn-sm btn-outline-secondary w-100 py-1 mt-2 copy-btn" data-copy="081327280676" style="font-size: 12px; border-radius: 8px;">
                                            Salin Nomor
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded-3 p-3 position-relative h-100 bg-pink">
                                        <img src="{{ asset('icons/dashboard/bni-icon.svg') }}" class="mb-3 mt-1" alt="BNI">
                                        <p class="fw-light mb-0" style="font-size: 10px;">No Rekening</p>
                                        <p class="mb-0 small">1952571644</p>
                                        <small class="fw-light d-block mb-2" style="font-size: 10px;">a.n Ahmed Amirul Azmi</small>
                                        <button class="btn btn-sm btn-outline-secondary w-100 py-1 mt-2 copy-btn" data-copy="1952571644" style="font-size: 12px; border-radius: 8px;">
                                            Salin Nomor
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <div class="w-100 w-sm-50">
                                    <button type="button" class="btn btn-cancel-custom w-100 rounded-3 py-2" style="height: 40px" data-bs-dismiss="modal">
                                        Batalkan
                                    </button>
                                </div>

                                <div class="w-100 w-sm-50">
                                    <form action="{{ route('hasPayment') }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-custom w-100 rounded-3 py-2 fw-semibold">
                                            Saya Sudah Bayar
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif 
    @include('sweetalert::alert')
@endsection