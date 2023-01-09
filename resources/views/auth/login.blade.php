@extends("layouts.auth")

@section("auth")
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
    @error('username')
    <div id="usernameInvalid" class="invalid-feedback">{{ $message }}</div>
    @else
    <div id="usernameHelp" class="form-text">Masukkan Username anda</div>
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