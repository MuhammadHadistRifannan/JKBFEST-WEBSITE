@extends('auth.layouts.app')
@section('title', 'Login')

@section('content')
    <!-- form login -->
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- PANEL KIRI -->
            <div class="col-lg-6 left-panel d-none d-lg-flex position-relative">
                <div class="corner-top position-absolute top-0 end-0 ">
                    <img src="{{ asset('images/corner-top.png') }}" alt="corner-top" />
                </div>

                <div class="corner-bottom position-absolute bottom-0 start-0 ">
                    <img src="{{ asset('images/corner-bottom.png') }}" alt="corner-bottom" />
                </div>

                <div class="left-content">
                    <img src="{{ asset('images/logo-jkb-fes.png') }}" alt="Logo" />
                    <h2 class="fw-bold mb-3">Welcome to JKB Festival</h2>
                    <p class="fw-light">Digital Competency and Innovation Arena designed to foster creativity, strengthen
                        digital skills, and drive technological innovation.</p>
                </div>
            </div>

            <!-- PANEL KANAN -->
            <div class="col-12 col-lg-6 right-panel position-relative">
                <div class="decor-rectangle position-absolute">
                    <img src="{{ asset('icons/auth/rectangle-auth.svg') }}" alt="">
                </div>

                <div class="decoration-top-right position-absolute top-0 end-0">
                    <img src="{{ asset('icons/auth/ellips.svg') }}" alt="ellips-decoration" />
                </div>

                <div class="register-card border-custom position-relative">
                    <div class="decoration-top-right position-absolute top-0 end-0">
                        <img src="{{ asset('icons/auth/top-corner-auth.svg') }}" alt="top-corner-decoration" />
                    </div>
                    <div class="card-header-custom text-start pt-4" style="padding-left: 32px; padding-right: 32px;">
                        <h3 class="fw-bold m-0 text-custom-purple">Login</h3>
                        <p class="m-0 small text-custom-purple">Silahkan Masuk Dengan Akun Anda</p>
                    </div>
                    <div class="card-header-custom mt-3" style="padding-left: 32px; padding-right: 32px;">
                        <img src="{{ asset('icons/auth/line.svg') }}" class="w-100 d-block" alt="line-decoration" />
                    </div>

                    <div class="padding-custom">
                        <form method="post" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="text-custom-purple form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/auth/mail.svg') }}" alt="mail" class="icon-svg">
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 shadow-none py-2" placeholder="Masukkan Email" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-custom-purple form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/password.svg') }}" alt="password" class="icon-svg">
                                    </span>
                                    <input type="password" name="password" id="passwordInput"
                                        class="form-control border-start-0 border-end-0 shadow-none py-2"
                                        placeholder="Masukkan Password" />
                                    <span class="input-group-text bg-white border-start-0 cursor-pointer py-2"
                                        id="togglePassword">
                                        <img src="{{ asset('icons/auth/eye.svg') }}" alt="eye" class="icon-svg">
                                    </span>
                                </div>
                            </div>

                            <button class="btn btn-register btn-gradient-custom py-2 shadow-sm">SIgn In</button>
                            <a href="/register" class="btn-signin py-2"> Belum memiliki akun? <span
                                    class="text-custom-purple fw-medium">Buat Akun</span> </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
