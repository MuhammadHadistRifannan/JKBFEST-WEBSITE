@extends('dashboard.layouts.app')

@section('title', 'Upload Karya')

@section('content')
    <div class="d-flex flex-column gap-4">

        {{-- 1. BAGIAN BANNER STATUS (DIPERBAIKI STRUKTUR IF-ELSE NYA) --}}
        @if (!auth()->user()->team)
            {{-- JIKA TIM BELUM DAFTAR --}}
            <div class="card-red-custom border-0 rounded-4 text-white p-4 d-flex flex-row align-items-center gap-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-center fs-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Belum Ada Tim</h4>
                    <small class="d-block fw-light">
                        Belum ada tim yang terdaftar. Silakan buat tim terlebih dahulu.
                    </small>
                </div>
            </div>

        @elseif (!auth()->user()->team->document)
            {{-- JIKA SUDAH DAFTAR TAPI BELUM LENGKAPI BERKAS --}}
            <div class="card-red-custom border-0 rounded-4 text-white p-4 d-flex flex-row align-items-center gap-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-center fs-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Lengkapi Berkas Team</h4>
                    <small class="d-block text-white-50">
                        Berkas belum dikumpulkan. Silakan lakukan pengumpulan berkas.
                    </small>
                </div>
            </div>

        @elseif (auth()->user()->team->document->status_document === 'pending')
            {{-- JIKA SUDAH KUMPUL BERKAS TAPI BELUM VERIFIKASI (PENDING) --}}
            <div class="card-red-custom border-0 rounded-4 text-white p-4 d-flex flex-row align-items-center gap-3 shadow-sm" style="background-color: #E25A45;">
                <div class="d-flex align-items-center justify-content-center fs-2">
                    <i class="bi bi-three-dots-circle-fill"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Menunggu Persetujuan</h4>
                    <small class="d-block text-white-50">
                        Saat ini data team anda sedang dalam proses peninjauan.
                    </small>
                </div>
            </div>

        @elseif (auth()->user()->team->document->status_document === 'rejected')
            {{-- JIKA BERKAS DITOLAK --}}
            <div class="card-red-custom border-0 rounded-4 text-white p-4 d-flex flex-row align-items-center gap-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-center fs-2">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1">Berkas Ditolak</h4>
                    <small class="d-block text-white-50">
                        Saat ini data team anda ditolak. Silakan perbaiki berkas Anda.
                    </small>
                </div>
            </div>

        @elseif (auth()->user()->team->document->status_document === 'approved')
            {{-- JIKA SUDAH DI VERIFIKASI --}}
            <div class="header-gradient-green card border-0 rounded-4 text-white p-4 d-flex flex-row align-items-center gap-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('icons/dashboard/check-icon.svg') }}" alt="check-icon">
                </div>
                <h3 class="fw-bold mb-0">
                    @if (isset($submission))
                        Karya Telah Dikumpulkan
                    @else
                        Team anda sudah terverifikasi
                    @endif
                </h3>
            </div>
        @endif

        <div style="display: none;">
        {{ 
            $submission =  auth()->user()->team->link_karya ?? null
         }}
        </div>

        {{-- 2. BAGIAN DETAIL SUBMISSION --}}
        <div class="row g-4">
            
            <div class="col-12 col-lg-8">
                <div class="card rounded-4 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 border-bottom pb-3">
                            <img src="{{ asset('icons/dashboard/medali-purple-icon.svg') }}" alt="medali-icon">
                            <h5 class="text-custom-purple fw-bold mb-0">Detail Submission</h5>
                        </div>

                        <div class="mb-4">
                            <small class="text-muted d-block mb-2 fw-semibold">Nama Tim</small>
                            {{-- Menggunakan nullsafe (?->) agar tidak error jika user belum buat tim --}}
                            <h5 class="fw-bold text-dark mb-0">{{ auth()->user()->team?->team_name ?? '-' }}</h5>
                        </div>

                        {{-- CEK STATUS TIM --}}
                        @if (auth()->user()->team?->status_team)

                            @if (isset($submission))
                                {{-- Jika Sudah Upload Proposal --}}
                                <div class="rounded-3 p-4 d-flex align-items-center gap-3"
                                    style="background-color: #F0FDF4; border: 1px solid #267228;">
                                    <div>
                                        <img src="{{ asset('icons/dashboard/check-icon-green.svg') }}" alt="check-icon-green" />
                                    </div>
                                    <div>
                                        <h5 class="fw-semibold mb-1" style="color: #267228;">Link Proposal Dikirim</h5>
                                        <small class="fw-light d-block " style="color: #267228;">
                                            Terima kasih, link proposal telah kami terima. Mohon menunggu informasi
                                            selanjutnya.
                                        </small>
                                    </div>
                                </div>
                            @else
                                {{-- Jika Tim Verified Tapi Belum Upload Proposal --}}
                                <form action="{{ route('uploadKarya') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-2 fw-semibold">Form Submission</small>
                                        <input type="text" name="link_karya" class="form-control p-3 rounded-3"
                                            placeholder="Masukkan Link Proposal" required>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-custom w-100 py-2 rounded-3 d-flex align-items-center justify-content-center gap-2 fw-semibold">
                                        <i class="bi bi-send-fill"></i> Kirim
                                    </button>
                                </form>
                            @endif

                        @elseif (auth()->user()->team?->document?->status_document === 'rejected')
                            {{-- Jika Berkas Ditolak --}}
                            <div class="d-flex flex-column gap-2 mb-4 border-bottom pb-3">
                                <h5 class="text-danger fw-bold mb-0">Alasan Ditolak : </h5>
                                {{-- Ubah "alasan_penolakan" sesuai nama kolom di database kamu --}}
                                <p class="text-muted mb-0">
                                    {{ auth()->user()->team->document->alasan_ditolak ?? 'Silakan cek kembali berkas pendaftaran tim Anda dan hubungi panitia.' }}
                                </p>
                            </div>
                            
                        @else
                            {{-- Jika Belum Upload Berkas / Masih Pending --}}
                            <div class="alert alert-warning rounded-3 border-0">
                                Silakan selesaikan proses pendaftaran dan tunggu verifikasi tim dari admin untuk dapat mengunggah karya.
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- Informasi --}}
            <div class="col-12 col-lg-4">
                <div class="card rounded-4 shadow-sm ">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-4 border-bottom pb-3">
                            <img src="{{ asset('icons/dashboard/information-icon.svg') }}" alt="information-icon">
                            <h5 class="text-custom-purple fw-bold mb-0">Informasi Lanjutan</h5>
                        </div>

                        <div class="bg-pink-new p-3 rounded-4 mb-4">
                            <p class="mb-0 small text-dark">
                                Bergabung dengan grup whatsApp untuk informasi terbaru
                            </p>
                        </div>

                        <div>
                            <small class="text-muted d-block mb-1 fw-semibold">Grup Whatsapp Lomba</small>
                            <a href="#" class="text-decoration-underline fw-medium d-flex align-items-center gap-2"
                                style="color: #27AE60;">
                                <i class="bi bi-whatsapp fs-5"></i>
                                Bergabung Grup WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FOOTER INFO --}}
        <div class="card border-0 rounded-4 p-4 text-center shadow d-flex align-items-center justify-content-center"
            style="background-color: #FFF8F0;">
            <p class="fw-semibold mb-0 small text-custom-purple">
                @if (isset($submission))
                    Karya Anda telah berhasil dikumpulkan. Hasil penilaian akan diumumkan di instagram @jkbfest setelah
                    periode perlombaan berakhir.
                @else
                    Untuk mendapatkan informasi terbaru serta pengumuman selanjutnya, silakan bergabung ke grup WhatsApp
                    resmi yang telah disediakan.
                @endif
            </p>
        </div>

    </div>
    @include('sweetalert::alert')
@endsection