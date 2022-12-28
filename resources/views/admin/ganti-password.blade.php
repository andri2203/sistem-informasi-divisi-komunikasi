@extends("layouts.admin")

@section("adminContent")
<h3 class="text-bold">Ganti Password</h3>

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

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="/admin/ganti-password" method="post">
            @csrf
            <div class="row g-3 mb-3 align-items-center">
                <label for="passwordLama" class="col-sm-1 col-form-label">Password Lama</label>
                <div class="col-sm-3">
                    <input type="password" name="passwordLama" id="passwordLama" class="form-control">
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <label for="passwordBaru" class="col-sm-1 col-form-label">Password Baru</label>
                <div class="col-sm-3">
                    <input type="password" name="passwordBaru" id="passwordBaru" class="form-control">
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <label for="konfirmasiPassword" class="col-sm-1 col-form-label">Password Lama</label>
                <div class="col-sm-3">
                    <input type="password" name="konfirmasiPassword" id="konfirmasiPassword" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary">Ubah Password</button>
        </form>
    </div>
</div>
@endSection