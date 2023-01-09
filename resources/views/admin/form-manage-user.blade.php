@extends("layouts.dashboard")

@section("dashboard")
<h3 class="text-bold mb-4">Form Akses Pegawai Dishub Kodim IM</h3>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="/manage/user" method="post" class="row justify-content-center">
    @csrf
    <div class="col-sm-7">
        <div class="row mb-3">
            <label for="pegawai" class="col-sm-3 col-form-label">Pegawai</label>
            <div class="col-sm-9">
                <select name="pegawai" id="pegawai" class="form-control">
                    <option value="">-- Pilih Pegawai</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->nip }}/{{ $employee->nama }}-{{ $employee->gol }}/{{ $employee->jabatan }}</option>
                    @endforeach
                </select>
                @error('pegawai')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-5">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required @error('konfirmasiPassword') autofocus @enderror>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="konfirmasiPassword" class="col-sm-3 col-form-label">Konfirmasi Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control @error('konfirmasiPassword') is-invalid @enderror" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Ulangi Password" required>
                @error('konfirmasiPassword')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Tambah Akses User</button>
            </div>
        </div>
    </div>
</form>

@endSection