@extends("layouts.admin")

@section("adminContent")
<h3 class="fw-bold text-center mb-4">Data Pegawai</h3>

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

<div class="d-flex justify-content-center mb-4">
    <form action="/admin/pegawai/{{ $employee_id??'' }}" class="w-75" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nip" name="nip" placeholder="Nomor Induk Pegawai" required value="@if($employee !=null){{ old('nip', $employee->nip) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required value="@if($employee !=null){{ old('nama', $employee->nama) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
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
            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Pegawai" required value="@if($employee !=null){{ old('jabatan', $employee->jabatan) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="status" name="status" placeholder="Status Pegawai" required value="@if($employee !=null){{ old('status', $employee->status) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="gol" class="col-sm-2 col-form-label">Golongan / Pangkat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="gol" name="gol" placeholder="Golongan Pegawai" required value="@if($employee !=null){{ old('gol', $employee->gol) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="alamat" name="alamat" rows="3">@if($employee !=null){{ old('alamat', $employee->alamat) }}@endif</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
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
    </form>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
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
                        <div class="btn-group">
                            <a href="/admin/pegawai/{{ $pegawai->id }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                            <a href="/admin/pegawai/hapus/{{ $pegawai->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endSection