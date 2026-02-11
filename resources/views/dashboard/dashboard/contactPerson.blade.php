@extends('dashboard.layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
    {{-- HEADER --}}
    <div class="mb-5 text-center">
        <h3 class="fw-medium mb-2 text-dark">Hubungi Kami</h3>
        <p class="fw-light mx-auto" style="max-width: 700px;">
            Ada Pertanyaan tentang kompetisi? Kirim Pesan atau Hubungi Contact Person kami dalam
            acara Lomba Web Development ini
        </p>
    </div>

    <div class="card p-4 mx-3 rounded-4 shadow-sm bg-white">
        <div class="row g-5 align-items-stretch">

            {{--  FORM PESAN --}}
            <div class="col-lg-7">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" name="name"
                            class="border-secondary form-control rounded-3 py-2 bg-light border-1"
                            placeholder="Masukkan Nama" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email"
                            class="border-secondary form-control rounded-3 py-2 bg-light border-1"
                            placeholder="Masukkan Email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pesan</label>
                        <textarea name="message" class="border-secondary form-control rounded-3 py-2 bg-light border-1" rows="5"
                            placeholder="Masukkan Pesan">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-custom w-100 rounded-3 fw-bold py-2 mt-2">
                        <img src="{{ asset('icons/dashboard/send.svg') }}" alt=""> Kirim
                    </button>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="custom-gradient rounded-4 position-relative w-100 shadow-sm"
                    style=" padding-top: 80px; padding-bottom: 0px;">

                    <div class="bg-white rounded-4 pt-5 px-4 shadow text-center position-relative"
                        style="min-height: 380px; top: 0;">
                        <div
                            class="floating-icon position-absolute start-50 translate-middle-x d-flex align-items-center justify-content-center">
                            <img src="{{ asset('icons/dashboard/floating-icon.svg') }}" alt="">
                        </div>

                        <h5 class="fw-semibold mb-3 mt-4 text-custom-purple">Web Development</h5>
                        <div class="mx-auto mb-4"
                            style="height: 4px; width: 60%; background: linear-gradient(90deg, #FFF7AD 0%, #FFB3AE 25%, #FF49C1 50%, #6A1452 75%, #44113E 100%);">
                        </div>

                        <p class="text-muted fs-5 mb-1 mt-5">Contact Person</p>
                        <h4 class="fw-medium text-dark mb-2">Draco Malfoy Potter</h4>
                        <p class="text-secondary mb-5 fs-5">
                            <i class="bi bi-telephone-fill me-2 fs-5"></i> +62 869 555 4329
                        </p>

                        <a href="https://wa.me/628695554329" target="_blank"
                            class="btn btn-custom w-100 rounded-3 fw-bold py-3 mb-3 mb-sm-4">
                            <i class="bi bi-whatsapp me-2"></i> Hubungi Via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
