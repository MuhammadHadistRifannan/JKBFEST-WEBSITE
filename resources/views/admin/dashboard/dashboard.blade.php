@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .hero-gradient-admin {
        background: linear-gradient(135deg, #5C104B 0%, #D81E76 50%, #FF8D70 100%);
    }

    .countdown-gradient {
        background: linear-gradient(135deg, #A41F7B 0%, #761456 100%);
    }

    .text-custom-purple {
        color: #5C104B !important;
    }

    .text-custom-pink {
        color: #D81E76 !important;
    }

    .bg-soft-pink {
        background-color: #FCEDF2 !important;
    }

    .stat-card {
        transition: transform 0.2s;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .pie-chart {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: conic-gradient(
            #FF49C1 0deg 120deg, 
            #44113E 120deg 240deg, 
            #FFD1A9 240deg 360deg 
        );
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .legend-indicator {
        width: 12px;
        height: 12px;
        border-radius: 4px;
        display: inline-block;
    }

    .timeline-container {
        position: relative;
        padding-left: 20px;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 4px;
        top: 8px;
        bottom: 20px;
        width: 2px;
        background-color: #F0F0F0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 12px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -22px;
        top: 18px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: #F0F0F0;
        border: 3px solid #FFF;
        z-index: 2;
    }

    .timeline-dot.active {
        background-color: #D81E76;
    }

    .timeline-card {
        background-color: #F8F9FA;
        border-radius: 10px;
        padding: 12px 16px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }

    .timeline-card.active {
        background-color: #FCEDF2;
        border-left-color: #D81E76;
    }

    .recent-activity-item {
        background-color: #FCEDF2;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .recent-activity-item:last-child {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        
        <div class="hero-gradient-admin card text-white p-4 p-md-5 mb-4 rounded-4 border-0 shadow-sm position-relative overflow-hidden">
            <div class="z-3 position-relative">
                <h2 class="fw-bold mb-2">Selamat Datang Admin!!</h2>
                <p class="mb-0 fw-light" style="max-width: 480px;">
                    Pantau statistik pendaftar, validasi berkas, dan kelola seluruh tahapan kompetisi dengan sistematis.
                </p>
            </div>
            <div class="corner-dash position-absolute top-0 end-0 opacity-75">
                <img src="{{ asset('images/corner-top-dash.png') }}" alt="corner-top-dash" style="width: 200px; object-fit: cover;">
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-people-fill text-custom-purple mb-2" style="font-size: 2.8rem;"></i>
                    <h2 class="fw-bold text-dark mb-0">45</h2>
                    <span class="text-muted small fw-medium">Total Tim Terdaftar</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm rounded-4 p-4 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-wallet-fill text-custom-purple mb-2" style="font-size: 2.5rem;"></i>
                    <h4 class="fw-bold text-dark mb-1 mt-2">Rp 4.500.000</h4>
                    <span class="text-muted small fw-medium">Total Pendapatan</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm rounded-4 p-3 h-100">
                    <p class="fw-bold text-dark mb-3 text-center" style="font-size: 14px;">Status Verifikasi</p>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <div class="pie-chart flex-shrink-0"></div>
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-1 gap-2">
                                <small class="text-muted d-flex align-items-center fw-medium" style="font-size: 11px;">
                                    <span class="legend-indicator me-2" style="background:#FF49C1;"></span> Pending
                                </small>
                                <small class="fw-bold">: 5</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-1 gap-2">
                                <small class="text-muted d-flex align-items-center fw-medium" style="font-size: 11px;">
                                    <span class="legend-indicator me-2" style="background:#44113E;"></span> Ditolak
                                </small>
                                <small class="fw-bold">: 5</small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <small class="text-muted d-flex align-items-center fw-medium" style="font-size: 11px;">
                                    <span class="legend-indicator me-2" style="background:#FFD1A9;"></span> disetujui
                                </small>
                                <small class="fw-bold">: 5</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm p-4">
            <h5 class="fw-bold text-custom-purple mb-4">Recent Activity</h5>
            
            <div class="recent-activity-item">
                <div>
                    <h6 class="fw-bold text-custom-purple mb-1">Berkas di Verifikasi</h6>
                    <small class="text-muted fw-medium">Berkas Team Langsung di ACC saja di verifikasi admin</small>
                </div>
                <small class="text-muted">Hari ini</small>
            </div>

            <div class="recent-activity-item">
                <div>
                    <h6 class="fw-bold text-custom-purple mb-1">Berkas di Verifikasi</h6>
                    <small class="text-muted fw-medium">Berkas Team Langsung di ACC saja di verifikasi admin</small>
                </div>
                <small class="text-muted">Hari ini</small>
            </div>

            <div class="recent-activity-item">
                <div>
                    <h6 class="fw-bold text-custom-purple mb-1">Berkas di Verifikasi</h6>
                    <small class="text-muted fw-medium">Berkas Team Langsung di ACC saja di verifikasi admin</small>
                </div>
                <small class="text-muted">Hari ini</small>
            </div>
        </div>

    </div>

    <div class="col-lg-4">
        
        <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
            <h5 class="fw-bold text-dark mb-1">Kalender</h5>
            <small class="text-muted d-block mb-4 fw-medium">Jadwal Lomba JKB Fest</small>

            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-dot active"></div>
                    <div class="timeline-card active">
                        <h6 class="fw-bold text-custom-purple mb-1">Pendaftaran</h6>
                        <small class="text-muted">3 April - 26 April 2026</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Pengumpulan</h6>
                        <small class="text-muted">3 April - 2 Mei 2026</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Seleksi</h6>
                        <small class="text-muted">3 Mei - 14 Mei 2026</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Pengumuman</h6>
                        <small class="text-muted">15 Mei 2026</small>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Teknikal Meeting</h6>
                        <small class="text-muted">16 Mei 2026</small>
                    </div>
                </div>

                <div class="timeline-item extra-timeline d-none">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Final Project</h6>
                        <small class="text-muted">22 Mei 2026</small>
                    </div>
                </div>

                <div class="timeline-item extra-timeline d-none">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <h6 class="fw-bold text-dark mb-1">Awarding</h6>
                        <small class="text-muted">23 Mei 2026</small>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="#" id="toggleTimelineBtn" class="text-decoration-none text-primary fw-medium" style="font-size: 13px;">Selanjutnya ></a>
            </div>
        </div>

        <div class="card border-0 rounded-4 shadow-sm p-4">
            <h6 class="fw-bold text-dark mb-3">Sedang Berlangsung</h6>
            
            <div class="bg-soft-pink rounded-3 p-3 mb-3 border border-light">
                <h6 class="fw-bold text-custom-purple mb-1">Pendaftaran</h6>
                <small class="text-muted fw-medium" style="font-size: 12px;">Ditutup : 26 April 2026</small>
            </div>

            <div class="countdown-gradient rounded-3 p-4 text-white d-flex align-items-center gap-3">
                <i class="bi bi-clock fs-1"></i>
                <div>
                    <h4 class="fw-bold mb-0">12 Hari Lagi</h4>
                    <small class="fw-light" style="font-size: 12px;">Menuju Penutupan Pendaftaran</small>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

{{-- Script Khusus untuk fitur Hide/Show Kalender --}}
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('toggleTimelineBtn');
        const extraItems = document.querySelectorAll('.extra-timeline');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah halaman scroll ke atas saat link diklik
                
                let isHidden = false;

                // Toggle class 'd-none' (display:none bawaan bootstrap)
                extraItems.forEach(item => {
                    item.classList.toggle('d-none');
                    if (item.classList.contains('d-none')) {
                        isHidden = true;
                    }
                });

                // Ubah teks tombol sesuai dengan kondisinya
                if (isHidden) {
                    toggleBtn.innerText = 'Selanjutnya >';
                } else {
                    toggleBtn.innerText = '< Sembunyikan';
                }
            });
        }
    });
</script>
@endsection