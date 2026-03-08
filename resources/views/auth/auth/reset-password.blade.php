@extends('auth.layouts.app')
@section('title', 'Reset Password')

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
                        <h3 class="fw-bold m-0 text-custom-purple" style="color: #4A154D;">Reset Password</h3>
                        <p class="m-0 small text-dark mt-1" style="font-weight: 500;">Silahkan Reset Password</p>
                    </div>
                    
                    <div class="card-header-custom mt-3" style="padding-left: 32px; padding-right: 32px;">
                        <img src="{{ asset('icons/auth/line.svg') }}" class="w-100 d-block" alt="line-decoration" />
                    </div>

                    <div class="padding-custom pt-4">
                        <form method="post" action="{{ route('reset-password') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">

                            <div class="mb-3">
                                <label class="text-dark form-label fw-bold" style="font-size: 14px;">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/auth/mail.svg') }}" alt="mail" class="icon-svg">
                                    </span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 shadow-none py-2 @error('email') is-invalid @enderror" 
                                        value="{{ $email ?? old('email') }}" placeholder="Masukkan Email" required readonly/>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="text-dark form-label fw-bold" style="font-size: 14px;">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/auth/password.svg') }}" alt="password" class="icon-svg">
                                    </span>
                                    <input type="password" name="password" id="passwordInput"
                                        class="form-control border-start-0 border-end-0 shadow-none py-2 @error('password') is-invalid @enderror" 
                                        placeholder="Masukkan Password" required />
                                    <span class="input-group-text bg-white border-start-0 cursor-pointer py-2" id="togglePassword">
                                        <img src="{{ asset('icons/auth/eye.svg') }}" alt="show password" class="icon-svg" id="eyeIconImage" style="width: 24px !important; height: 24px !important; object-fit: contain;">
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="text-dark form-label fw-bold" style="font-size: 14px;">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 py-2">
                                        <img src="{{ asset('icons/auth/password.svg') }}" alt="password" class="icon-svg">
                                    </span>
                                    <input type="password" name="password_confirmation" id="newPasswordInput"
                                        class="form-control border-start-0 border-end-0 shadow-none py-2 @error('password_confirmation') is-invalid @enderror" 
                                        placeholder="Masukkan Password Baru" required />
                                    <span class="input-group-text bg-white border-start-0 cursor-pointer py-2" id="toggleNewPassword">
                                        <img src="{{ asset('icons/auth/eye.svg') }}" alt="show password" class="icon-svg" id="eyeIconNewImage" style="width: 24px !important; height: 24px !important; object-fit: contain;">
                                    </span>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-register btn-gradient-custom w-100 py-2 shadow-sm mb-2" style="font-size: 15px;">
                                Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi reusable untuk mengatur toggle password
            function setupPasswordToggle(toggleSpanId, inputId, iconId) {
                const toggleSpan = document.getElementById(toggleSpanId);
                const inputField = document.getElementById(inputId);
                const eyeIcon = document.getElementById(iconId);

                if(toggleSpan && inputField && eyeIcon) {
                    toggleSpan.addEventListener("click", function() {
                        const type = inputField.getAttribute("type") === "password" ? "text" : "password";
                        inputField.setAttribute("type", type);
                        
                        if (type === "text") {
                            eyeIcon.src = "{{ asset('icons/auth/eye-slash.svg') }}";
                            eyeIcon.alt = "hide password";
                        } else {
                            eyeIcon.src = "{{ asset('icons/auth/eye.svg') }}";
                            eyeIcon.alt = "show password";
                        }
                    });
                }
            }

            // Terapkan ke field "Password"
            setupPasswordToggle("togglePassword", "passwordInput", "eyeIconImage");
            
            // Terapkan ke field "New Password"
            setupPasswordToggle("toggleNewPassword", "newPasswordInput", "eyeIconNewImage");
        });
    </script>
@endsection