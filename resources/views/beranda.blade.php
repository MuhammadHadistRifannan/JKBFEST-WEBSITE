<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo-jkb-fes.png') }}" type="image/x-icon">
    <title>JKB Festival 2026 - Politeknik Negeri Cilacap</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF;
            overflow-x: hidden;
            color: #333;
        }

        /* =========================================
           RESPONSIVE TYPOGRAPHY & PADDING
           ========================================= */
        .hero-pad {
            padding-top: 6rem;
            /* Dorong konten ke bawah menjauhi navbar */
            padding-bottom: 6rem;
            /* Beri ruang di bawah agar tidak menabrak lengkungan */
        }

        .hero-title {
            font-size: 4.8rem;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        /* PERBAIKAN: Padding Web Dev ditingkatkan drastis dan size jadi cover agar menutup semuanya */
        .webdev-pad {
            padding-top: 15rem;
            /* Meningkat dari 10rem */
            padding-bottom: 15rem;
            /* Meningkat dari 12rem */
            background-size: cover;
            /* Pastikan cover menutup penuh */
        }

        .about-title {
            font-size: 38px;
        }

        .about-title span {
            font-size: 44px;
        }

        .about-circle-wrapper {
            width: 320px;
            height: 320px;
        }

        .hero-big-logo {
            width: 120% !important;
            max-width: 120% !important;
            margin-left: -10% !important;
            margin-top: -5% !important;
            filter: drop-shadow(0 0 50px rgba(255, 255, 255, 0.4));
        }

        .countdown-container {
            background-color: rgba(0, 0, 0, 0.15);
        }

        /* =========================================
           FAQ & ASSET CARDS
           ========================================= */
        .accordion-faq .accordion-item {
            border: 1px solid #D81E76;
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
            background-color: #FCEDF2;
            color: #5b1456;
        }

        .asset-card-custom {
            border: 2px solid #5b1456 !important;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .asset-card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(91, 20, 86, 0.15) !important;
        }

        /* =========================================
           TIMELINE SECTION
           ========================================= */
        #timeline {
            position: relative;
            background-color: #FAFAFA;
            z-index: 1;
            overflow: hidden;
        }

        #timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('images/logo-besar.png') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 60%;
            opacity: 0.2;
            z-index: -1;
        }

        .timeline-line::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 4px;
            background-color: #5b1456;
            transform: translateX(-50%);
            z-index: 0;
        }

        .timeline-card-wrapper {
            background: linear-gradient(135deg, #FF9933 0%, #D81E76 100%);
            border-radius: 166px;
            padding: 2px;
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .timeline-card-body {
            background: white;
            border-radius: 14px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .timeline-date-badge {
            background-color: #5b1456;
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 14px;
            margin-top: auto;
            width: 100%;
        }

        .timeline-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #FFD1A9, #FF9933);
            color: #5b1456;
            z-index: 2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(255, 153, 51, 0.3);
        }

        /* =========================================
           MEDIA QUERIES (RESPONSIVE HP)
           ========================================= */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(91, 20, 86, 0.95);
                padding: 15px;
                border-radius: 12px;
                margin-top: 10px;
            }


            .hero-pad {
                padding-top: 12rem;
                /* Dorong konten ke bawah menjauhi navbar */
                padding-bottom: 8rem;
                /* Beri ruang di bawah agar tidak menabrak lengkungan */
            }

            .hero-title {
                font-size: 3.5rem;
            }

            .text-lg-start {
                text-align: center !important;
            }

            /* .hero-big-logo {
                width: 100% !important;
                max-width: 400px !important;
                margin-left: 0 !important;
                margin-top: 3rem;
            } */

            .countdown-container {
                width: 100%;
                max-width: 350px;
                display: block;
                margin: 0 auto 30px auto;
            }

            .countdown-items {
                justify-content: center;
            }

            .hero-actions {
                justify-content: center;
            }

            .about-circle-wrapper {
                width: 250px;
                height: 250px;
                margin-bottom: 30px;
            }

            /* Web Dev Mobile adjustment */
            .webdev-pad {
                padding-top: 10rem;
                /* Tetap besar di mobile */
                padding-bottom: 10rem;
                background-size: cover;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .about-title {
                font-size: 28px;
            }

            .about-title span {
                font-size: 32px;
            }

            .about-circle-wrapper {
                width: 200px;
                height: 200px;
            }

            .timeline-line::before {
                left: 20px;
                transform: none;
            }

            .timeline-row {
                flex-direction: column;
                margin-bottom: 30px !important;
            }

            .timeline-col {
                width: 100% !important;
                padding-left: 60px !important;
                padding-right: 15px !important;
                justify-content: flex-start !important;
            }

            .timeline-card-wrapper {
                max-width: 100%;
            }

            .timeline-card-body {
                text-align: left !important;
            }

            .timeline-circle {
                left: 20px !important;
                top: 0 !important;
                transform: translate(-50%, 0) !important;
                width: 35px;
                height: 35px;
                font-size: 14px;
            }

            #timeline::before {
                background-size: 90%;
                opacity: 0.1;
            }

            .countdown-box {
                min-width: 60px;
            }

            .countdown-number {
                font-size: 26px !important;
            }
        }

        /* Navbar */
        .navbar-scrolled {
            background-color: #65144F;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease-in-out;
        }

        #mainNavbar {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top w-100 z-3 shadow p-0" data-aos="fade-down" data-aos-duration="1000"
        id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('svg/logo-jkb-navbar.svg') }}" alt="JKB Fest">
            </a>

            <button class="navbar-toggler border-0 shadow-none text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1 text-white"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-4">
                    <li class="nav-item"><a class="nav-link text-white fw-medium" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-medium" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-medium" href="#asset">Asset</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-medium" href="#timeline">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-medium" href="#faq">FAQ</a></li>

                    <li class="nav-item mt-3 mt-lg-0">
                        <a class="btn bg-white rounded-pill px-4 py-2 fw-bold text-decoration-none d-flex align-items-center gap-2 shadow-sm"
                            style="color: #5b1456; font-size: 13px;" href="{{ route('login.view') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="position-relative overflow-hidden hero-pad"
        style="background-image: url('{{ asset('images/hero-background.png') }}'); background-size: cover; background-position: center bottom; background-repeat: no-repeat;">

        <div class="container position-relative z-2">
            <div class="row align-items-center">

                <div class="col-lg-6 text-white text-center text-lg-start">
                    <p class="fw-semibold mb-2" style="font-size: 10px; letter-spacing: 1.5px;" data-aos="fade-right"
                        data-aos-delay="200">COMPUTER AND BUSINESS DEPARTMENT PRESENT</p>
                    <h1 class="fw-bolder mb-3 hero-title" data-aos="fade-right" data-aos-delay="400">JKB
                        Festival<br>2026</h1>
                    <p class="fs-5 fw-normal mb-4" data-aos="fade-right" data-aos-delay="600">JKB Innovate, Create, and
                        Impact</p>

                    <div class="d-inline-block rounded-4 p-4 mb-4 text-start countdown-container" data-aos="fade-up"
                        data-aos-delay="800">
                        <p class="fw-bold mb-3" style="font-size: 12px;">Pendaftaran Terakhir</p>
                        <div class="d-flex gap-3 gap-md-4 countdown-items">
                            <div class="text-center countdown-box">
                                <div class="fw-bold lh-1 countdown-number" style="font-size: 36px;" id="days">00
                                </div>
                                <div class="fw-normal" style="font-size: 11px;">Hari</div>
                            </div>
                            <div class="text-center countdown-box">
                                <div class="fw-bold lh-1 countdown-number" style="font-size: 36px;" id="hours">00
                                </div>
                                <div class="fw-normal" style="font-size: 11px;">Jam</div>
                            </div>
                            <div class="text-center countdown-box">
                                <div class="fw-bold lh-1 countdown-number" style="font-size: 36px;" id="minutes">00
                                </div>
                                <div class="fw-normal" style="font-size: 11px;">Menit</div>
                            </div>
                            <div class="text-center countdown-box">
                                <div class="fw-bold lh-1 countdown-number" style="font-size: 36px;" id="seconds">00
                                </div>
                                <div class="fw-normal" style="font-size: 11px;">Detik</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap"
                        data-aos="fade-up" data-aos-delay="1000">
                        <a href="{{ route('register.view') }}" class="btn bg-white rounded-pill px-4 py-3 fw-bold"
                            style="color: #5b1456; font-size: 14px;">Daftar Sekarang</a>
                        <a href="#tentang" class="btn rounded-pill px-4 py-3 fw-semibold text-white"
                            style="border: 1.5px solid white; font-size: 14px;">Pelajari lebih lanjut</a>
                    </div>
                </div>

                <div class="col-lg-6 text-center position-relative mt-5 mt-lg-0" style="z-index: 10;"
                    data-aos="zoom-in" data-aos-duration="1500">
                    <img src="{{ asset('svg/hero-JKB-mini.svg') }}" class="img-fluid hero-big-logo"
                        alt="JKB Fest Big Logo">
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="position-relative z-1 py-5"
        style="background-color: #FFFFFF; background-image: radial-gradient(#e0e0e0 2px, transparent 2px); background-size: 30px 30px;">
        <div class="container py-5 my-md-5">
            <div class="row align-items-center g-5">

                <div class="col-lg-5 text-center" data-aos="fade-right" data-aos-duration="1000">
                    <div
                        class="bg-white rounded-circle shadow-lg d-flex align-items-center justify-content-center mx-auto about-circle-wrapper">
                        <img src="{{ asset('images/vektor-code.png') }}" class="img-fluid w-50" alt="Code Vector">
                    </div>
                </div>

                <div class="col-lg-7 text-center text-lg-start" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="fw-bolder mb-4 about-title" style="color: #5b1456;">Apa itu JKB FESTIVAL <span
                            class="fw-bold">?</span></h2>

                    <p class="text-secondary mb-4" style="font-size: 15px; line-height: 1.9;">
                        JKB FEST hadir sebagai agenda tahunan HIMATRIS Politeknik Negeri Cilacap untuk memeriahkan Dies
                        Natalis Jurusan Komputer dan Bisnis. Perayaan ini dirancang sebagai wadah inovasi serta
                        kreativitas bagi mahasiswa dan masyarakat luas di bidang teknologi maupun bisnis.
                    </p>

                    <p class="text-secondary mb-0" style="font-size: 15px; line-height: 1.9;">
                        Melalui rangkaian kompetisi dan seminar, festival ini menjadi ruang untuk mempererat kolaborasi
                        serta kebersamaan antar civitas akademika. Semangat kami adalah menjadikan momen ini sebagai
                        pusat pengembangan potensi yang lebih hidup, bermakna, dan penuh inspirasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white text-center webdev-pad"
        style="background-image: url('{{ asset('images/vektor-gelombang-ungu.png') }}'); background-position: center; background-repeat: no-repeat;">
        <div class="container" data-aos="zoom-in-up" data-aos-duration="1000">
            <h1 class="fw-bolder mb-4" style="font-size: 36px;">Web Development</h1>
            <p class="mx-auto" style="max-width: 900px; font-size: 15px; line-height: 1.9; opacity: 0.9;">
                Kompetisi Web Development JKB Festival Himatris hadir sebagai wadah mahasiswa untuk mengasah kreativitas
                dan kompetensi digital. Mengusung tema "D-CORE: Digital Competency and Innovation Arena", ajang ini
                mendorong lahirnya inovasi web yang kolaboratif dan berdampak, sekaligus membuka ruang bagi talenta muda
                untuk berjejaring dan berkontribusi dalam ekosistem teknologi masa depan.
            </p>
        </div>
    </section>

    <section id="asset" class="py-5 text-center" style="background-color: #FAFAFA;">
        <div class="container py-5">
            <div class="d-inline-block position-relative mb-5" data-aos="fade-up">
                <h2 class="fw-bolder mb-0" style="color: #5b1456; font-size: 32px;">Download Assets</h2>
                <div class="position-absolute bottom-0 start-50 translate-middle-x"
                    style="width: 80%; height: 4px; background: linear-gradient(135deg, #D81E76 0%, #FF9933 100%); border-radius: 10px; margin-bottom: -15px;">
                </div>
            </div>

            <div class="row justify-content-center g-4 mt-3">
                <div class="col-12 col-sm-8 col-md-5 col-lg-4" data-aos="flip-left" data-aos-delay="100">
                    <div class="bg-white asset-card-custom p-4 p-md-5 h-100 shadow-sm">
                        <img src="{{ asset('images/icon-guidebook.png') }}" alt="Guidebook" class="img-fluid mb-4"
                            style="height: 90px;">
                        <h6 class="fw-bold text-dark mb-4">GUIDEBOOK<br>JKB FESTIVAL</h6>
                        <button class="btn text-white rounded-3 w-100 py-2 fw-semibold"
                            style="background-color: #5b1456; font-size: 14px;">Download</button>
                    </div>
                </div>
                <div class="col-12 col-sm-8 col-md-5 col-lg-4" data-aos="flip-right" data-aos-delay="300">
                    <div class="bg-white asset-card-custom p-4 p-md-5 h-100 shadow-sm">
                        <img src="{{ asset('images/icon-logo-pack.png') }}" alt="Logo Pack" class="img-fluid mb-4"
                            style="height: 90px;">
                        <h6 class="fw-bold text-dark mb-4">LOGO PACK<br>& ASSETS</h6>
                        <button class="btn text-white rounded-3 w-100 py-2 fw-semibold"
                            style="background-color: #5b1456; font-size: 14px;">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="timeline" class="py-5 text-center">
        <div class="container position-relative z-2 pb-4" data-aos="fade-up">
            <div class="d-inline-block position-relative mb-4">
                <h2 class="fw-bolder mb-0" style="color: #5b1456; font-size: 32px;">Timeline Lomba</h2>
                <div class="position-absolute bottom-0 start-50 translate-middle-x"
                    style="width: 80%; height: 4px; background: linear-gradient(135deg, #D81E76 0%, #FF9933 100%); border-radius: 10px; margin-bottom: -15px;">
                </div>
            </div>
            <p class="text-muted small mt-4 px-3">Informasi tahapan dan waktu pelaksanaan kegiatan Lomba Web JKB
                Festival</p>
        </div>

        <div class="container position-relative timeline-line mt-4 mx-auto pb-5"
            style="max-width: 900px; z-index: 2;">

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-right">
                <div class="col-md-6 pe-md-5 timeline-col d-flex justify-content-end">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Pendaftaran</h5>
                            <p class="text-muted small mb-3">Tahap awal JKB Fest di mana calon peserta mendaftarkan
                                diri sesuai persyaratan yang ditetapkan.</p>
                            <div class="timeline-date-badge">3 - 26 April 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">1</div>
            </div>

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-left">
                <div class="col-md-6 offset-md-6 ps-md-5 timeline-col d-flex justify-content-start">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Pengumpulan</h5>
                            <p class="text-muted small mb-3">Peserta yang telah mendaftar wajib mengumpulkan karya atau
                                proyek sesuai tema JKB Fest.</p>
                            <div class="timeline-date-badge">3 April - 2 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">2</div>
            </div>

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-right">
                <div class="col-md-6 pe-md-5 timeline-col d-flex justify-content-end">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Seleksi</h5>
                            <p class="text-muted small mb-3">Panitia dan dewan juri melakukan penilaian terhadap
                                seluruh karya yang masuk.</p>
                            <div class="timeline-date-badge">3 - 14 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">3</div>
            </div>

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-left">
                <div class="col-md-6 offset-md-6 ps-md-5 timeline-col d-flex justify-content-start">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Pengumuman</h5>
                            <p class="text-muted small mb-3">Hasil seleksi disampaikan kepada peserta melalui media
                                resmi JKB Fest.</p>
                            <div class="timeline-date-badge">15 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">4</div>
            </div>

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-right">
                <div class="col-md-6 pe-md-5 timeline-col d-flex justify-content-end">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Technical Meeting</h5>
                            <p class="text-muted small mb-3">Penjelasan teknis pelaksanaan kegiatan bagi peserta yang
                                lolos seleksi.</p>
                            <div class="timeline-date-badge">16 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">5</div>
            </div>

            <div class="row timeline-row mb-4 position-relative" data-aos="fade-left">
                <div class="col-md-6 offset-md-6 ps-md-5 timeline-col d-flex justify-content-start">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Final Project</h5>
                            <p class="text-muted small mb-3">Peserta mempresentasikan karya yang telah dibuat secara
                                langsung di Politeknik.</p>
                            <div class="timeline-date-badge">22 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">6</div>
            </div>

            <div class="row timeline-row mb-0 position-relative" data-aos="fade-right">
                <div class="col-md-6 pe-md-5 timeline-col d-flex justify-content-end">
                    <div class="timeline-card-wrapper shadow-sm">
                        <div class="timeline-card-body">
                            <h5 class="fw-bolder mb-2" style="color: #5b1456;">Awarding</h5>
                            <p class="text-muted small mb-3">Pengumuman pemenang serta pemberian penghargaan kepada
                                peserta.</p>
                            <div class="timeline-date-badge">23 Mei 2026</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-circle">7</div>
            </div>

        </div>
    </section>

    <section id="sponsor" class="text-center position-relative"
        style="padding-top: 15rem; padding-bottom: 15rem; margin-top: -40px; z-index: 3;">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background-image: url('{{ asset('images/vektor-gelombang-ungu.png') }}'); background-size: cover; background-position: center; transform: scaleX(-1); z-index: -1;">
        </div>

        <div class="container position-relative z-2">
            <h2 class="fw-bolder text-white mb-5 d-inline-block pb-2" style="border-bottom: 3px solid #FF9933;"
                data-aos="fade-up">Sponsor By</h2>

            <div class="row justify-content-center g-3 mb-5">
                <div class="col-5 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="100">
                    <div class="rounded-4 d-flex align-items-center justify-content-center p-3 shadow"
                        style="background: linear-gradient(135deg, #FFD1A9, #FFFFFF); height: 90px;"><i
                            class="bi bi-gear-fill fs-2 text-secondary"></i></div>
                </div>
                <div class="col-5 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="200">
                    <div class="rounded-4 d-flex align-items-center justify-content-center p-3 shadow"
                        style="background: linear-gradient(135deg, #FFD1A9, #FFFFFF); height: 90px;"><i
                            class="bi bi-gear-fill fs-2 text-secondary"></i></div>
                </div>
                <div class="col-5 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="300">
                    <div class="rounded-4 d-flex align-items-center justify-content-center p-3 shadow"
                        style="background: linear-gradient(135deg, #FFD1A9, #FFFFFF); height: 90px;"><i
                            class="bi bi-gear-fill fs-2 text-secondary"></i></div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq"
        style="background-color: #FAFAFA; border-top-left-radius: 80px; border-top-right-radius: 80px; padding: 6rem 0; margin-top: -60px; position: relative; z-index: 4;">
        <div class="container px-4">
            <div class="text-center" data-aos="fade-up">
                <h2 class="fw-bolder text-dark mb-2">Pertanyaan Umum</h2>
                <p class="text-muted small mx-auto mb-4" style="max-width: 600px;">Informasi dan jawaban atas
                    pertanyaan umum mengenai JKB Fest disajikan di halaman ini.</p>
                <div class="mx-auto mb-5"
                    style="width: 80px; height: 4px; background: linear-gradient(135deg, #D81E76 0%, #FF9933 100%); border-radius: 5px;">
                </div>
            </div>

            <div class="container text-start p-0" style="max-width: 850px;">
                <div class="accordion accordion-faq" id="accordionFAQ">
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1">
                                <i class="bi bi-question-circle me-3 fs-5"></i> Apakah boleh mengganti anggota tim
                                setelah mendaftar?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">Penggantian anggota tim diperbolehkan maksimal H-3 sebelum
                                penutupan pendaftaran dengan menghubungi panitia resmi.</div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq2">
                                <i class="bi bi-question-circle me-3 fs-5"></i> Apa saja yang harus disiapkan saat
                                mendaftar?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">Siapkan Kartu Tanda Mahasiswa (KTM) aktif dan pastikan mengisi
                                formulir pendaftaran secara lengkap.</div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq3">
                                <i class="bi bi-question-circle me-3 fs-5"></i> Di mana peserta bisa mendapatkan
                                informasi resmi JKB Fest?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">Informasi resmi akan dipublikasikan di website ini dan
                                Instagram @himatris.pnc.</div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq4">
                                <i class="bi bi-question-circle me-3 fs-5"></i> Apakah lomba ini dilaksanakan secara
                                daring atau luring?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">Tahap seleksi dilakukan secara daring, sedangkan Final Project
                                dan Awarding dilaksanakan secara luring di kampus.</div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq5">
                                <i class="bi bi-question-circle me-3 fs-5"></i> Apakah satu instansi dapat mengirim
                                lebih dari satu tim?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">Sangat diperbolehkan, tanpa batasan jumlah perwakilan dari satu
                                instansi.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // INISIALISASI ANIMASI AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true, // Animasi hanya berjalan satu kali saat discroll ke bawah
            offset: 100 // Jarak trigger animasi dari bawah layar
        });

        // SCRIPT COUNTDOWN
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

        // Navbar Change on Scroll
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById("mainNavbar");

            window.addEventListener("scroll", function() {
                if (window.scrollY > 50) {
                    navbar.classList.add("navbar-scrolled");

                } else {
                    navbar.classList.remove("navbar-scrolled");

                }
            });
        });
    </script>
</body>

</html>
