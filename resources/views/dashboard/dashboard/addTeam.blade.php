@extends('dashboard.layouts.app')

@section('title', 'Buat Team')

@section('content')
    {{-- HEADER --}}
    <div class="mb-4 mx-3">
        <h3 class="fw-semibold mb-2 text-custom-purple">Buat Team Kamu</h3>
        <p class="fw-light">
            Buat dan kelola tim kamu sebagai langkah awal mengikuti lomba JKB Fest. Persiapkan tim terbaikmu untuk
            berkompetisi dan berinovasi.
        </p>
    </div>

    {{-- FORM BUAT TEAM --}}
    <div class="card p-5 mx-3 rounded-4 shadow-sm">
        <form action="#" method="POST">
            @csrf
            <h5 class="fw-bold text-custom-purple mb-4">Lengkapi Team</h5>
            <div class="row g-4 mb-4">
                <div class="col-md-6 order-0">
                    <label class="form-label fw-semibold">Nama Team</label>
                    <input type="text" name="team_name" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Nama Team" value="{{ old('team_name') }}">
                </div>

                <div class="col-md-6 order-1">
                    <label class="form-label fw-semibold">Asal Instansi</label>
                    <input type="text" name="institution" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Asal Instansi" value="{{ old('institution') }}">
                </div>

                <div class="col-md-6 order-2">
                    <label class="form-label fw-semibold">Ketua Team</label>
                    <input type="text" class="form-control rounded-3 input-readonly-custom py-2"
                        value="{{ auth()->user()->name ?? 'Harry Potter' }}" readonly>
                </div>

                <div class="col-md-6 order-md-4 order-3">
                    <label class="form-label fw-semibold">Nomer Hp Ketua Team</label>
                    <input type="text" class="form-control rounded-3 input-readonly-custom py-2"
                        value="{{ auth()->user()->phone ?? '08555 787870 7776' }}" readonly>
                </div>

                <div class="col-md-6 order-md-3 order-4">
                    <label class="form-label fw-semibold">Nama Pembimbing</label>
                    <input type="text" name="advisor_name" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Nama Pembimbing" value="{{ old('advisor_name') }}">
                </div>

                <div class="col-md-6 order-5">
                    <label class="form-label fw-semibold">Nomer Hp Pembimbing</label>
                    <input type="text" name="advisor_phone" class="form-control rounded-3 py-2"
                        placeholder="Masukkan No HP Pembimbing" value="{{ old('advisor_phone') }}">
                </div>
            </div>

            <hr class="border-secondary border-3 opacity-25 my-5">


            {{-- TEAM MEMBER --}}
            <h5 class="fw-bold text-custom-purple mb-4">Team Member</h5>

            <div class="row g-4 mb-5">
                {{-- Member 1 --}}
                <div class="col-md-6 order-0">
                    <label class="form-label fw-semibold">Member 1</label>
                    <input type="text" name="member_1_name" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Member 1" value="{{ old('member_1_name') }}">
                </div>

                <div class="col-md-6 order-md-2 order-1">
                    <label class="form-label fw-semibold">Nomer Hp</label>
                    <input type="text" name="member_1_phone" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Nomer HP" value="{{ old('member_1_phone') }}">
                </div>

                {{-- Member 2 --}}
                <div class="col-md-6 order-md-1 order-2">
                    <label class="form-label fw-semibold">Member 2</label>
                    <input type="text" name="member_2_name" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Member 2" value="{{ old('member_2_name') }}">
                </div>

                <div class="col-md-6 order-3">
                    <label class="form-label fw-semibold">Nomer Hp</label>
                    <input type="text" name="member_2_phone" class="form-control rounded-3 py-2"
                        placeholder="Masukkan Nomer HP" value="{{ old('member_2_phone') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-custom w-100 rounded-3 fw-bold py-2">
                Daftarkan Team
            </button>

        </form>
    </div>
@endsection
