@extends("layouts.dashboard")

@section("dashboard")
<h3 class="fw-bold text-center mb-4">Data Pegawai Dishub Kodim IM</h3>

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

<form action="/manage/pegawai{{ $employee_id?'/'.$employee_id:'' }}" class="row g-3" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-5">
        <div class="row mb-3 pe-2">
            <div class="col-sm-12 text-center">
                @if($employee && $employee->image != null)
                <img src="{{ asset('storage/'.$employee->image) }}" alt="Foto User" class=" img-fluid rounded mb-2" style="width: 60%;">
                @else
                <img src="/images/no-user.jpg" alt="Foto User" class=" img-fluid rounded mb-2" style="width: 60%;">
                @endif
            </div>
            <label for="image" class="col-sm-3 col-form-label">Foto Pegawai</label>
            <div class="col-sm-9">
                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file">
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="row mb-3">
            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai" required value="@if($employee !=null){{ old('nip', $employee->nip) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required value="@if($employee !=null){{ old('nama', $employee->nama) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-9">
                <select class="form-select" aria-label="Default select" name="jk" id="jk" autofocus required>
                    <option value="">Pilih Jenis Kelamin</option>
                    @foreach($jk as $d)
                    <option value="{{ $d }}" @if($employee !=null && $d==old('jk', $employee->jk)) selected @endif>
                        {{ $d }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Pegawai" required value="@if($employee !=null){{ old('jabatan', $employee->jabatan) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-9">
                <select class="form-select" aria-label="Default select" name="status" id="status" required>
                    <option value="">Pilih Status</option>
                    @foreach($status as $d)
                    <option value="{{ $d }}" @if($employee !=null && $d==old('status', $employee->status)) selected @endif>
                        {{ $d }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="gol" class="col-sm-3 col-form-label">Golongan / Pangkat</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="gol" name="gol" placeholder="Golongan Pegawai" required value="@if($employee !=null){{ old('gol', $employee->gol) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="alamat" name="alamat" rows="3">@if($employee !=null){{ old('alamat', $employee->alamat) }}@endif</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pimpinan" id="pimpinan" value="1" @if($employee !=null && old('jk', $employee->pimpinan)) checked @endif>
                    <label class="form-check-label" for="pimpinan">
                        Sebagai Pimpinan
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col">
                <div class="btn-group mt-3 mx-auto" role="group" aria-label="Basic example">
                    @if($employee_id == null)
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    @else
                    <button class="btn btn-success" type="submit">Ubah</button>
                    @endif
                    <button class="btn btn-warning" type="reset">Reset</button>
                </div>
            </div>
        </div>
    </div>
</form>

<hr class="my-4">

<table class="table table-bordered bg-white">
    <thead>
        <tr class=" table-dark">
            <th>#</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Golongan / Pangkat</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($employees as $pegawai)
        <tr @if($pegawai->pimpinan) class="table-primary" @endif >
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $pegawai->nip }}</td>
            <td>{{ $pegawai->nama }}</td>
            <td>{{ $pegawai->jk }}</td>
            <td>{{ $pegawai->jabatan }}</td>
            <td>{{ $pegawai->status }}</td>
            <td>{{ $pegawai->gol }}</td>
            <td>{{ $pegawai->alamat }}</td>
            <td>
                @if($pegawai->id != auth()->user()->id_pegawai)
                @if($pegawai->id != $employee_id)
                <div class="btn-group">
                    <a href="/manage/pegawai/{{ $pegawai->id }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                    <a href="/manage/pegawai/hapus/{{ $pegawai->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </div>
                @else
                <a href="/manage/pegawai" class="btn btn-sm btn-info">Kembali</a>
                @endif
                @else
                <a href="/profil" class="btn btn-sm btn-info"><i class="fa-solid fa-user"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endSection