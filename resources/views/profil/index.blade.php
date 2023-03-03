@extends("layouts.dashboard")

@section("dashboard")
<h2 class="text-bold text-center mb-4">Profil</h2>

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

<div class="row justify-content-center g-3 mb-3">
    <div class="col-sm-4">
        <div class="d-flex flex-column align-items-center">
            @if($employee && $employee->image != null)
            <img src="/files/{{ $employee->image }}" alt="Foto User" class="w-75 img-fluid rounded mb-2">
            @else
            <img src="/images/no-user.jpg" alt="Foto User" class="w-75 img-fluid rounded mb-2">
            @endif
            <form action="/profil/ubah-foto{{ $employee?'/'.$employee->id:'' }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file">
                    <button type="submit" class="btn btn-primary" @if(!$employee) disabled @endif>Ubah</button>
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-5">
        <form @if($employee) action="/profil/ubah-profil/{{ $employee->id }}" @else action="/profil/tambah-profil" @endif method="post">
            @csrf
            <div class="row mb-3">
                <label for="nip" class="col-form-label col-sm-3">NIP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control ctrl @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="NIP Anggota" value="{{ old('nip', $employee->nip??'') }}" required @if($employee) disabled @endif>
                    @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama" class="col-form-label col-sm-3">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control ctrl" id="nama" name="nama" placeholder="Nama Anggota" value="{{ $employee->nama??auth()->user()->name }}" required @if($employee) disabled @endif>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nip" class="col-form-label col-sm-3">Jenis Kelamin</label>
                <div class="col-sm-5">
                    <select class="form-select ctrl" aria-label="Default select" name="jk" id="jk" autofocus required @if($employee) disabled @endif>
                        <option value="">Pilih Jenis Kelamin</option>
                        @foreach($jk as $d)
                        <option value="{{ $d }}" @if($employee !=null && $employee->jk == $d) selected @endif>
                            {{ $d }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jabatan" class="col-form-label col-sm-3">Jabatan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control ctrl" id="Jabatan" name="jabatan" placeholder="Jabatan Anggota" value="{{ $employee->jabatan??'' }}" required @if($employee) disabled @endif>
                </div>
            </div>

            <div class="row mb-3">
                <label for="status" class="col-form-label col-sm-3">Status</label>
                <div class="col-sm-5">
                    <select class="form-select ctrl" aria-label="Default select" name="status" id="status" required @if($employee) disabled @endif>
                        <option value="">Pilih Status</option>
                        @foreach($status as $d)
                        <option value="{{ $d }}" @if($employee !=null && $employee->status == $d) selected @endif>
                            {{ $d }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="gol" class="col-form-label col-sm-3">Golongan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control ctrl" id="gol" name="gol" placeholder="Golongan / Jabatan" value="{{ $employee->gol??'' }}" required @if($employee) disabled @endif>
                </div>
            </div>

            <div class="row mb-3">
                <label for="divisi" class="col-form-label col-sm-3">Divisi</label>
                <div class="col-sm-5">
                    <select class="form-select ctrl" aria-label="Default select" name="divisi" id="divisi" required @if($employee) disabled @endif>
                        <option value="">Pilih Divisi</option>
                        @foreach($divisi as $d)
                        <option value="{{ $d->id }}" @if($employee !=null && $employee->divisi == $d->id) selected @endif>
                            {{ $d->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="alamat" class="col-form-label col-sm-3">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control ctrl" id="alamat" name="alamat" rows="3" placeholder="Alamat Tinggal" @if($employee) disabled @endif>{{ $employee->alamat??'' }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success ctrl" @if($employee) disabled @endif>Ubah Data Diri</button>
                        <button type="button" id="aktif-btn" class="btn btn-info">Aktifkan Form</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection