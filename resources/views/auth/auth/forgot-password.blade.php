@extends('auth.layouts.app')
@section('title', 'Lupa Password')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <div class="col-lg-6 left-panel d-none d-lg-flex position-relative">
                <div class="corner-top position-absolute top-0 end-0">
                    <img src="{{ asset('images/corner-top.png') }}" alt="corner-top" />
                </div>

                <div class="corner-bottom position-absolute bottom-0 start-0">
                    <img src="{{ asset('images/corner-bottom.png') }}" alt="corner-bottom" />
                </div>

                <div class="left-content">
                    <img src="{{ asset('images/logo-jkb-fes.png') }}" alt="Logo" />
                    <h2 class="fw-bold mb-3">Welcome to JKB Festival</h2>
                    <p class="fw-light">Digital Competency and Innovation Arena designed to foster creativity, strengthen
                        digital skills, and drive technological innovation.</p>
                </div>
            </div>

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
                        <h3 class="fw-bold m-0 text-custom-purple" style="color: #4A154D;">Lupa Password</h3>
                        <p class="m-0 small text-dark mt-1" style="font-weight: 500;">Silahkan Masukan Email Pemulihan</p>
                    </div>
                    
                    <div class="card-header-custom mt-3" style="padding-left: 32px; padding-right: 32px;">
                        <img src="{{ asset('icons/auth/line.svg') }}" class="w-100 d-block" alt="line-decoration" />
                    </div>

                    <div class="padding-custom pt-4">
                        {{-- Ganti action route dengan route penanganan lupa password Anda nantinya --}}
                        <form method="post" action="{{ route('forgotpassword') }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="text-dark form-label fw-bold" style="font-size: 14px;">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/auth/mail.svg') }}" alt="mail" class="icon-svg">
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 shadow-none py-2" placeholder="Masukkan Email" required />
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-register btn-gradient-custom w-100 py-2 shadow-sm mb-4" style="font-size: 15px;">
                                Send Password Reset Link
                            </button>

                            <div class="text-center mt-2">
                                <a href="{{ route('login.view') }}" class="text-dark fw-bold text-decoration-none" style="font-size: 14px;">
                                    Kembali Ke Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection