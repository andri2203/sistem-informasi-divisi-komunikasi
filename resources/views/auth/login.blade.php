@extends("layouts.auth")

@section("auth")
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" required autofocus>
    @error('email')
    <div id="emailInvalid" class="invalid-feedback">{{ $message }}</div>
    @else
    <div id="emailHelp" class="form-text">Masukkan Email anda</div>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
</div>
@endSection

@section("authLink")
<span class="mt-2">
    Belum Memiliki Akun? <a href="/auth/register">Daftar</a>
</span>
@endSection