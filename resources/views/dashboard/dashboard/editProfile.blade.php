@extends('dashboard.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    {{-- HEADER --}}
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="/dashboard" class="text-decoration-none text-dark">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h5 class="text-custom-purple fw-semibold mb-0">Edit Profile Anda</h5>
        </div>
    </div>

    {{-- FORM EDIT PROFILE --}}
    <div class="card p-4 rounded-4 shadow-sm">
        <form action={{ route('updateProfile') }} method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control rounded-3 py-2"
                        value="{{ old('name', auth()->user()->name ?? 'Harry Potter') }}">
                        @error('name')
                            {{ $message }}
                        @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Role</label>
                    <input type="text" class="form-control rounded-3 input-readonly-custom py-2"
                        value="{{ auth()->user()->role ?? 'Ketua' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control rounded-3 py-2"
                        value="{{ old('email', auth()->user()->email ?? 'harrypotter@gmail.com') }}">
                        @error('email')
                            {{ $message }}
                        @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Status Team</label>
                    <input type="text" class="form-control rounded-3 input-readonly-custom py-2"
                        value="{{ auth()->user()->team->status_team ? 'Terverifikasi' :  'Belum Terverifikasi' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor HP</label>
                    <input type="text" name="phone" class="form-control rounded-3 py-2"
                        value="{{ old('phone', auth()->user()->no_telp ?? '085695554328') }}">
                        @error('phone')
                            {{ $message }}
                        @enderror
                </div>
            </div>

            <hr class=" border-secondary border-3 opacity-25 " style="margin-top: 36px; margin-bottom: 36px;">

            <div class="d-flex flex-column flex-sm-row gap-2 mb-4">
                <a href="{{ route('dashboard') }}"
                    class="btn btn-cancel-custom w-100 w-sm-50rounded-3 fw-bold py-2 d-flex align-items-center justify-content-center text-center">
                    Batalkan
                </a>

                <button type="submit" class="btn btn-custom w-100 w-sm-50 rounded-3 fw-bold py-2">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
    @include('sweetalert::alert')
@endsection
