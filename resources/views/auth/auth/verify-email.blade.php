@extends('auth.layouts.app')
@section('title', 'Verifikasi Email')

@section('styles')
<style>
    .otp-wrapper {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 24px;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 24px;
        font-weight: 600;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        background-color: #FFFFFF;
        color: #333;
        transition: all 0.2s;
    }

    .otp-input:focus {
        border-color: #D81E76;
        outline: none;
        box-shadow: 0 0 0 3px rgba(216, 30, 118, 0.1);
    }

    /* Hilangkan panah up/down pada input type number */
    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .envelope-icon-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .envelope-icon {
        width: 80px;
        height: auto;
        filter: drop-shadow(0px 8px 12px rgba(216, 30, 118, 0.2));
    }
</style>
@endsection

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
                        <h3 class="fw-bold m-0 text-custom-purple" style="color: #4A154D;">Verifikasi Email</h3>
                    </div>
                    
                    <div class="card-header-custom mt-3" style="padding-left: 32px; padding-right: 32px;">
                        <img src="{{ asset('icons/auth/line.svg') }}" class="w-100 d-block" alt="line-decoration" />
                    </div>

                    <div class="padding-custom pt-4 text-center">
                        
                        <div class="envelope-icon-wrapper">
                            {{-- Gunakan ikon amplop SVG atau gambar dari folder Anda. Jika belum ada asset, ini menggunakan ikon Bootstrap --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#FF49C1" class="bi bi-envelope-fill envelope-icon" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                            </svg>
                        </div>

                        <p class="text-dark mb-4 mx-auto" style="font-size: 14px; max-width: 320px;">
                            Masukkan 6-digit kode verifikasi yang dikirim ke email <span class="fw-bold">Emailpeserta@gmail.com</span>
                        </p>

                        <form method="post" action="#">
                            @csrf
                            
                            <div class="otp-wrapper">
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp1" autocomplete="off" autofocus>
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp2" autocomplete="off">
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp3" autocomplete="off">
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp4" autocomplete="off">
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp5" autocomplete="off">
                                <input type="text" class="otp-input" maxlength="1" name="otp[]" id="otp6" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-register btn-gradient-custom w-100 py-2 shadow-sm mb-3" style="font-size: 15px;">
                                Verifikasi
                            </button>

                            <div class="mt-3">
                                <span class="text-muted" style="font-size: 14px;">Tidak Menerima Kode?</span>
                                <a href="#" class="text-custom-purple fw-bold text-decoration-none" style="font-size: 14px;">
                                    Kirim Ulang
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll('.otp-input');

            inputs.forEach((input, index) => {
                // Event saat mengetik
                input.addEventListener('input', function() {
                    // Hanya izinkan angka
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Pindah ke input selanjutnya jika sudah diisi
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                // Event saat menekan backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                        inputs[index - 1].focus();
                        inputs[index - 1].value = ''; // Opsional: hapus nilai sebelumnya
                    }
                });

                // Event saat paste kode OTP (langsung terisi ke semua kotak)
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, inputs.length);
                    
                    for (let i = 0; i < pastedData.length; i++) {
                        inputs[i].value = pastedData[i];
                    }

                    // Fokus ke input terakhir yang terisi
                    if(pastedData.length > 0) {
                        if(pastedData.length < inputs.length) {
                            inputs[pastedData.length].focus();
                        } else {
                            inputs[inputs.length - 1].focus();
                            inputs[inputs.length - 1].blur(); // Lepas fokus jika semua terisi penuh
                        }
                    }
                });
            });
        });
    </script>
@endsection