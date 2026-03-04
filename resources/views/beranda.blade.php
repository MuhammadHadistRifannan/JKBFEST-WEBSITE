<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo-jkb-fes.png') }}" type="image/x-icon">
    <title>JKB Festival 2026 - Politeknik Negeri Cilacap</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-purple: #5b1456; 
            --dark-purple: #3e0b3b;
            --primary-pink: #D81E76;
            --light-pink: #FCEDF2;
            --gradient-pink-orange: linear-gradient(135deg, #D81E76 0%, #FF9933 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF;
            overflow-x: hidden;
            color: #333;
        }

        /* ========================================================
           NAVBAR
           ======================================================== */
        .navbar {
            background: transparent;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 100;
            padding: 25px 0;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-size: 13px;
            font-weight: 500;
            margin: 0 12px;
            letter-spacing: 0.5px;
        }
        .navbar-nav .nav-link:hover {
            opacity: 0.8;
        }
        .btn-login-nav {
            background: white;
            color: var(--primary-purple);
            border: none;
            border-radius: 50px;
            padding: 8px 24px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-login-nav:hover {
            background-color: var(--light-pink);
            transform: translateY(-2px);
        }

        /* ========================================================
           HERO SECTION
           ======================================================== */
        .hero-wrapper {
            position: relative;
            background-color: var(--primary-purple);
            /* Pastikan overflow visible agar vektor wave bisa menonjol keluar */
            overflow: visible; 
            z-index: 10;
        }

        .hero-content {
            padding-top: 130px; 
            padding-bottom: 80px;
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-subtitle {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .hero-title {
            font-size: 4.8rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .hero-desc {
            font-size: 1.1rem;
            font-weight: 400;
            margin-bottom: 30px;
        }

        /* Countdown Box */
        .countdown-container {
            background-color: rgba(0, 0, 0, 0.15); 
            border-radius: 16px;
            padding: 18px 24px;
            display: inline-block;
            margin-bottom: 35px;
        }
        .countdown-title {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .countdown-items {
            display: flex;
            gap: 20px;
        }
        .countdown-box {
            text-align: center;
            min-width: 45px;
        }
        .countdown-number {
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
        }
        .countdown-label {
            font-size: 10px;
            font-weight: 400;
        }

        /* Tombol Hero */
        .btn-hero-solid {
            background: white;
            color: var(--primary-purple);
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 14px;
            border: none;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-hero-solid:hover {
            background: var(--light-pink);
            transform: translateY(-2px);
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            border: 1.5px solid white;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-hero-outline:hover {
            background: white;
            color: var(--primary-purple);
        }

        /* Gambar Logo Besar di Hero */
        .hero-logo-container {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .hero-big-logo {
            max-width: 130% !important; 
            width: 130% !important;
            height: auto;
            object-fit: contain;
            margin-left: -15% !important;
            filter: drop-shadow(0 0 50px rgba(255, 255, 255, 0.5));
        }

        /* Vektor Gelombang Pembatas Menjorok ke Bawah */
        .hero-wave-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: auto;
            /* Mentransformasi gelombang agar berada 98% keluar dari blok ungu */
            transform: translateY(98%); 
            z-index: 5;
            pointer-events: none;
        }

        /* ========================================================
           SECTION TENTANG
           ======================================================== */
        .about-section {
            /* Padding atas besar agar area putih tidak tertutup gelombang */
            padding-top: 25vw; 
            padding-bottom: 100px;
            background-color: #FFFFFF;
            /* Pattern titik-titik (dotted grid) */
            background-image: radial-gradient(#e0e0e0 2px, transparent 2px);
            background-size: 30px 30px;
            position: relative;
            z-index: 1;
        }

        /* Wrapper lingkaran untuk vektor code */
        .about-circle-wrapper {
            width: 320px;
            height: 320px;
            background: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 45px rgba(0,0,0,0.06);
            margin: auto;
        }
        .about-circle-wrapper img {
            width: 55%;
            height: auto;
            object-fit: contain;
        }

        .about-title {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary-purple);
            margin-bottom: 25px;
        }
        .about-title span {
            font-size: 42px;
            font-weight: 700;
        }

        .about-desc {
            color: #555;
            font-size: 15px;
            line-height: 1.9;
            margin-bottom: 25px;
            font-weight: 400;
        }

        /* ========================================================
           WEB DEVELOPMENT SECTION
           ======================================================== */
        .webdev-section {
            background-color: var(--dark-purple);
            padding: 120px 0;
            color: white;
            text-align: center;
            /* Opsional: Tambahkan background SVG wave di sini jika ada */
        }
        .webdev-title {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 25px;
        }
        .webdev-desc {
            max-width: 900px;
            margin: 0 auto;
            font-size: 15px;
            line-height: 1.9;
            opacity: 0.9;
            font-weight: 300;
        }

        /* ========================================================
           ASSETS SECTION
           ======================================================== */
        .assets-section {
            padding: 100px 0;
            background-color: #FAFAFA;
        }
        .section-title-gradient {
            font-weight: 800;
            color: var(--primary-purple);
            position: relative;
            display: inline-block;
            margin-bottom: 50px;
            font-size: 32px;
        }
        .section-title-gradient::after {
            content: '';
            position: absolute;
            width: 80%;
            height: 4px;
            background: var(--gradient-pink-orange);
            bottom: -15px;
            left: 10%;
            border-radius: 10px;
        }

        .asset-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #EAEAEA;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            transition: transform 0.3s;
            height: 100%;
        }
        .asset-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }
        .asset-icon-img {
            height: 100px;
            margin-bottom: 25px;
            object-fit: contain;
        }
        .btn-download-asset {
            background: var(--primary-purple);
            color: white;
            border-radius: 10px;
            width: 100%;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            transition: background 0.3s;
        }
        .btn-download-asset:hover { background: #2D0B2F; }

        /* ========================================================
           TIMELINE SECTION
           ======================================================== */
        .timeline-section {
            padding: 60px 0 100px 0;
            background-color: #FAFAFA;
        }
        .timeline-container {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            margin-top: 60px;
        }
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: var(--primary-purple);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -1.5px;
        }

        .timeline-block {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            margin-bottom: 30px;
        }
        .timeline-block.left { left: 0; }
        .timeline-block.right { left: 50%; }

        .timeline-number-circle {
            position: absolute;
            width: 45px;
            height: 45px;
            right: -22.5px;
            background: var(--gradient-pink-orange);
            border-radius: 50%;
            z-index: 10;
            top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-purple);
            font-weight: 800;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(255, 153, 51, 0.3);
        }
        .timeline-block.right .timeline-number-circle { left: -22.5px; }

        /* Card Timeline Gradient Border Simulation */
        .timeline-card-wrapper {
            background: var(--gradient-pink-orange);
            border-radius: 14px;
            padding: 2px; /* Tebal border gradient */
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .timeline-card-body {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            height: 100%;
        }
        .timeline-card-title {
            font-weight: 800;
            color: var(--primary-purple);
            margin-bottom: 10px;
            font-size: 18px;
        }
        .timeline-card-desc {
            font-size: 13px;
            color: #666;
            margin-bottom: 0;
            line-height: 1.6;
        }
        .timeline-card-date {
            display: inline-block;
            background: var(--primary-purple);
            color: white;
            font-weight: 600;
            font-size: 12px;
            padding: 8px 20px;
            border-radius: 8px;
            margin-top: 15px;
        }

        /* ========================================================
           SPONSOR & FAQ SECTION
           ======================================================== */
        .sponsor-faq-wrapper {
            background: var(--primary-purple);
            padding: 100px 0;
            border-top-left-radius: 100px;
            border-top-right-radius: 100px;
            margin-top: -50px; /* Overlap effect */
            position: relative;
            z-index: 5;
            color: white;
        }

        .sponsor-box-gradient {
            background: linear-gradient(135deg, #FFD1A9, #FFFFFF);
            border-radius: 12px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .faq-inner-section {
            background: #FAFAFA;
            border-top-left-radius: 100px;
            border-top-right-radius: 100px;
            padding: 100px 0;
            margin-top: 80px;
            color: #333;
        }

        .accordion-faq .accordion-item {
            border: 1px solid var(--primary-pink);
            border-radius: 50px !important;
            margin-bottom: 16px;
            overflow: hidden;
            background: white;
        }
        .accordion-faq .accordion-button {
            font-weight: 600;
            color: #333;
            padding: 18px 30px;
            box-shadow: none;
            border-radius: 50px !important;
            font-size: 15px;
        }
        .accordion-faq .accordion-button:not(.collapsed) {
            background-color: var(--light-pink);
            color: var(--primary-purple);
        }
        .accordion-faq .accordion-body {
            padding: 20px 30px;
            color: #666;
            font-size: 14px;
            line-height: 1.7;
        }

        /* ========================================================
           RESPONSIVE FIXES
           ======================================================== */
        @media screen and (max-width: 1199px) {
            .hero-big-logo {
                max-width: 100% !important;
                width: 100% !important;
                margin-left: 0 !important;
            }
        }

        @media screen and (max-width: 991px) {
            .hero-content {
                text-align: center;
                padding-top: 150px;
                padding-bottom: 60px;
            }
            .hero-title { font-size: 3rem; }
            .countdown-container { width: 100%; max-width: 350px; }
            .countdown-items { justify-content: center; }
            .hero-actions { justify-content: center; }
            .hero-logo-container { margin-top: 50px; }
            .hero-big-logo { max-width: 70% !important; width: 70% !important; filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.4)); }
            
            .about-section { padding-top: 35vw; text-align: center; }
            .about-circle-wrapper { width: 250px; height: 250px; margin-bottom: 40px; }
            
            .timeline-container::after { left: 31px; }
            .timeline-block { width: 100%; padding-left: 70px; padding-right: 20px; }
            .timeline-block.right { left: 0; }
            .timeline-number-circle { left: 8.5px !important; right: auto !important; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo-jkb-fes.png') }}" alt="JKB Fest" height="35">
            </a>
            <button class="navbar-toggler border-0 shadow-none text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#asset">Asset</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn-login-nav text-decoration-none" href="{{ route('login.view') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-wrapper">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="hero-subtitle">COMPUTER AND BUSINESS DEPARTMENT PRESENT</p>
                    <h1 class="hero-title">JKB Festival<br>2026</h1>
                    <p class="hero-desc">JKB Innovate, Create, and Impact</p>

                    <div class="countdown-container text-start">
                        <div class="countdown-title">Pendaftaran Terakhir</div>
                        <div class="countdown-items">
                            <div class="countdown-box">
                                <div class="countdown-number" id="days">00</div>
                                <div class="countdown-label">Hari</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="hours">00</div>
                                <div class="countdown-label">Jam</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="minutes">00</div>
                                <div class="countdown-label">Menit</div>
                            </div>
                            <div class="countdown-box">
                                <div class="countdown-number" id="seconds">00</div>
                                <div class="countdown-label">Detik</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 hero-actions flex-wrap">
                        <a href="{{ route('register.view') }}" class="btn-hero-solid">Daftar Sekarang</a>
                        <a href="#tentang" class="btn-hero-outline">Pelajari lebih lanjut</a>
                    </div>
                </div>
                
                <div class="col-lg-6 hero-logo-container">
                    <img src="{{ asset('images/logo-besar.png') }}" alt="JKB Fest Big Logo" class="hero-big-logo">
                </div>
            </div>
        </div>

        <img src="{{ asset('images/vektor-3warna.png') }}" class="hero-wave-divider" alt="Wave Divider">
    </section>

    <section id="tentang" class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center">
                    <div class="about-circle-wrapper">
                        <img src="{{ asset('images/vektor-code.png') }}" alt="Code Vector">
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <h2 class="about-title">Apa itu JKB FESTIVAL <span>?</span></h2>
                    
                    <p class="about-desc">
                        JKB FEST hadir sebagai agenda tahunan HIMATRIS Politeknik Negeri Cilacap untuk memeriahkan Dies Natalis Jurusan Komputer dan Bisnis. Perayaan ini dirancang sebagai wadah inovasi serta kreativitas bagi mahasiswa dan masyarakat luas di bidang teknologi maupun bisnis.
                    </p>
                    
                    <p class="about-desc mb-0">
                        Melalui rangkaian kompetisi dan seminar, festival ini menjadi ruang untuk mempererat kolaborasi serta kebersamaan antar civitas akademika. Semangat kami adalah menjadikan momen ini sebagai pusat pengembangan potensi yang lebih hidup, bermakna, dan penuh inspirasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="webdev-section">
        <div class="container">
            <h1 class="webdev-title">Web Development</h1>
            <p class="webdev-desc">
                Kompetisi Web Development JKB Festival Himatris hadir sebagai wadah mahasiswa untuk mengasah kreativitas dan kompetensi digital. Mengusung tema "D-CORE: Digital Competency and Innovation Arena", ajang ini mendorong lahirnya inovasi web yang kolaboratif dan berdampak, sekaligus membuka ruang bagi talenta muda untuk berjejaring dan berkontribusi dalam ekosistem teknologi masa depan.
            </p>
        </div>
    </section>

    <section id="asset" class="assets-section text-center">
        <div class="container">
            <h2 class="section-title-gradient">Download Assets</h2>
            
            <div class="row justify-content-center g-4 mt-2">
                <div class="col-md-5 col-lg-4">
                    <div class="asset-card">
                        <img src="{{ asset('images/icon-guidebook.png') }}" alt="Guidebook" class="asset-icon-img">
                        <h6 class="fw-bold text-dark mb-4">GUIDEBOOK<br>JKB FESTIVAL</h6>
                        <button class="btn-download-asset">Download</button>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="asset-card">
                        <img src="{{ asset('images/icon-logo-pack.png') }}" alt="Logo Pack" class="asset-icon-img">
                        <h6 class="fw-bold text-dark mb-4">LOGO PACK<br>& ASSETS</h6>
                        <button class="btn-download-asset">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="timeline" class="timeline-section text-center">
        <div class="container">
            <h2 class="section-title-gradient">Timeline Lomba</h2>
            <p class="text-muted small mt-1">Informasi tahapan dan waktu pelaksanaan kegiatan Lomba Web JKB Festival</p>
        </div>

        <div class="container timeline-container text-start">
            <div class="timeline-block left">
                <div class="timeline-number-circle">1</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Pendaftaran</h6>
                        <p class="timeline-card-desc">Tahap awal JKB Fest di mana calon peserta mendaftarkan diri sesuai persyaratan yang ditetapkan.</p>
                        <div class="timeline-card-date">3 - 26 April 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block right">
                <div class="timeline-number-circle">2</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Pengumpulan</h6>
                        <p class="timeline-card-desc">Peserta yang telah mendaftar wajib mengumpulkan karya atau proyek sesuai tema JKB Fest.</p>
                        <div class="timeline-card-date">3 April - 2 Mei 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block left">
                <div class="timeline-number-circle">3</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Seleksi</h6>
                        <p class="timeline-card-desc">Panitia dan dewan juri melakukan penilaian terhadap seluruh karya yang masuk.</p>
                        <div class="timeline-card-date">3 - 14 Mei 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block right">
                <div class="timeline-number-circle">4</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Pengumuman</h6>
                        <p class="timeline-card-desc">Hasil seleksi disampaikan kepada peserta melalui media resmi JKB Fest.</p>
                        <div class="timeline-card-date">15 Mei 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block left">
                <div class="timeline-number-circle">5</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Technical Meeting</h6>
                        <p class="timeline-card-desc">Penjelasan teknis pelaksanaan kegiatan bagi peserta yang lolos seleksi.</p>
                        <div class="timeline-card-date">16 Mei 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block right">
                <div class="timeline-number-circle">6</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Final Project</h6>
                        <p class="timeline-card-desc">Peserta mempresentasikan karya yang telah dibuat secara langsung di Politeknik Negeri Cilacap.</p>
                        <div class="timeline-card-date">22 Mei 2026</div>
                    </div>
                </div>
            </div>

            <div class="timeline-block left">
                <div class="timeline-number-circle">7</div>
                <div class="timeline-card-wrapper">
                    <div class="timeline-card-body">
                        <h6 class="timeline-card-title">Awarding</h6>
                        <p class="timeline-card-desc">Pengumuman pemenang serta pemberian penghargaan kepada peserta.</p>
                        <div class="timeline-card-date">23 Mei 2026</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="sponsor-faq-wrapper text-center">
        <div class="container">
            <h2 class="fw-bold mb-5" style="border-bottom: 3px solid #FF9933; display: inline-block; padding-bottom: 10px;">Sponsor By</h2>
            
            <div class="row justify-content-center g-3 mb-5 pb-5">
                <div class="col-5 col-md-3 col-lg-2">
                    <div class="sponsor-box-gradient"><i class="bi bi-gear-fill fs-2" style="color: #666;"></i></div>
                </div>
                <div class="col-5 col-md-3 col-lg-2">
                    <div class="sponsor-box-gradient"><i class="bi bi-gear-fill fs-2" style="color: #666;"></i></div>
                </div>
                <div class="col-5 col-md-3 col-lg-2">
                    <div class="sponsor-box-gradient"><i class="bi bi-gear-fill fs-2" style="color: #666;"></i></div>
                </div>
            </div>
        </div>

        <div class="faq-inner-section">
            <div class="container">
                <h2 class="fw-bold text-dark mb-2">Pertanyaan Umum</h2>
                <p class="text-muted small mx-auto mb-5" style="max-width: 600px;">Informasi dan jawaban atas pertanyaan umum mengenai JKB Fest disajikan di halaman ini.</p>
                <div style="width: 80px; height: 4px; background: var(--gradient-pink-orange); margin: -20px auto 40px auto; border-radius: 5px;"></div>

                <div class="container text-start" style="max-width: 850px;">
                    <div class="accordion accordion-faq" id="accordionFAQ">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="bi bi-question-circle me-3 fs-5"></i> Apakah boleh mengganti anggota tim setelah mendaftar?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">Penggantian anggota tim diperbolehkan maksimal H-3 sebelum penutupan pendaftaran dengan menghubungi panitia resmi.</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="bi bi-question-circle me-3 fs-5"></i> Apa saja yang harus disiapkan saat mendaftar?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">Siapkan Kartu Tanda Mahasiswa (KTM) aktif dan pastikan mengisi formulir pendaftaran secara lengkap.</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="bi bi-question-circle me-3 fs-5"></i> Di mana peserta bisa mendapatkan informasi resmi JKB Fest?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">Informasi resmi akan dipublikasikan di website ini dan Instagram @himatris.pnc.</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="bi bi-question-circle me-3 fs-5"></i> Apakah lomba ini dilaksanakan secara daring atau luring?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">Tahap seleksi dilakukan secara daring, sedangkan Final Project dan Awarding dilaksanakan secara luring di kampus.</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    <i class="bi bi-question-circle me-3 fs-5"></i> Apakah satu instansi dapat mengirim lebih dari satu tim?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                                <div class="accordion-body">Sangat diperbolehkan, tanpa batasan jumlah perwakilan dari satu instansi.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="background-color: var(--dark-purple); color: white; padding: 30px 0; text-align: center; font-size: 13px;">
        <p class="mb-0">&copy; 2026 Himatris Politeknik Negeri Cilacap. All rights reserved.</p>
    </div>

    <script>
        const countDownDate = new Date("Apr 26, 2026 23:59:59").getTime();
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
            }
        }, 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>