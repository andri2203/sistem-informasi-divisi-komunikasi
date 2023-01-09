@extends("layouts.dashboard")

@section("dashboard")
<h3 class="fw-bold text-center mb-4">{{ $title }}</h3>

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

@if($method == "GET")
<div class="d-flex justify-content-center">
    <form action="/admin/file" method="post" class="card w-50">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label for="divisi" class="form-label fw-bolder">Divisi</label>
                <select name="divisi" id="divisi" class="form-select">
                    @foreach($divisi as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="periode" class="form-label fw-bolder">Divisi</label>
                <input type="month" name="periode" id="periode" class="form-control" value="{{ date('Y-m') }}" required>
                @error('periode')
                <div class="invalid-feedback">{{ $messege }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Lihat File</button>
        </div>
    </form>
</div>
@endif


@if($method == "POST")
<h5 class="fw-bolder mb-3">Divisi : {{ $divisi->name }}</h5>
<a href="/admin/file" class="btn btn-outline-primary mb-3"><i class="fa-solid fa-angle-left"></i> Kembali</a>
<table class="table table-bordered">
    <thead>
        <tr class="table-dark">
            <th class="text-center" scope="col" width="30">#</th>
            <th class="text-center" scope="col">Nama</th>
            <th class="text-center" scope="col">NIP</th>
            <th class="text-center" scope="col">Keterangan</th>
            <th class="text-center" scope="col" width="200">File</th>
            <th class="text-center" scope="col" width="200">Dikirim</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp

        @if(count($files) == 0)
        <tr>
            <td colspan="7" class="text-center">Belum Ada Data File <span class="fw-bolder">{{ $divisi->name }}</span> di Periode {{ $periode->firstDay }} sampai {{ $periode->lastDay }}</td>
        </tr>
        @else

        @foreach($files as $file)
        <tr>
            <th class="align-middle text-center" scope="row">{{ $i++ }}</th>
            <td class="align-middle fw-bolder">{{ $file->nama }}</td>
            <td class="align-middle fw-bolder">{{ $file->nip }}</td>
            <td class="align-middle fw-bolder">{{ $file->keterangan }}</td>
            <td class="align-middle text-center"><a href="/download/{{ $file->id }}" class="btn btn-sm btn-info w-100" target="_blank"><i class="fa-solid fa-download"></i> Download File</a></td>
            <td class="align-middle text-center">{{ date('d F Y, H:i:s', strtotime($file->created_at)) }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endif
@endsection