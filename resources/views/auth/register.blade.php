@extends("layouts.auth")

@section("auth")
<div class="row g-3" style="width: 45vw;">
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus required value="{{ old('name') }}">
            @error('name')
            <div id="nameInvalid" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
            @error('username')
            <div id="usernameInvalid" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" required value="{{ old('email') }}">
            @error('email')
            <div id="emailInvalid" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
            <div id="passwordInvalid" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control @error('konfirmasiPassword') is-invalid @enderror" id="konfirmasiPassword" name="konfirmasiPassword" required>
            @error('konfirmasiPassword')
            <div id="konfirmasiPasswordInvalid" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@endSection

@section("authLink")
<span class="mt-2">
    Sudah Memiliki Akun? <a href="/auth/login">Masuk</a>
</span>
@endSection