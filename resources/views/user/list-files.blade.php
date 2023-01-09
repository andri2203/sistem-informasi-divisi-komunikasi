@extends("layouts.dashboard")

@section("dashboard")
<h3 class="fw-bold text-center mb-4">Daftar File Terkirim</h3>

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

<table class="table table-bordered">
    <thead>
        <tr class="table-dark">
            <th class="text-center" scope="col" width="30">#</th>
            <th class="text-center" scope="col">Keterangan</th>
            <th class="text-center" scope="col" width="100">File</th>
            <th class="text-center" scope="col" width="100">Dikirim</th>
            <th class="text-center" scope="col" width="90">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp

        @foreach($files as $file)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td class="fw-bolder">{{ $file->keterangan }}</td>
            <td><a href="/download/{{ $file->id }}" class="btn btn-sm btn-info" target="_blank"><i class="fa-solid fa-download"></i> Download File</a></td>
            <td>{{ $file->created_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="/upload_file/edit/{{ $file->id }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                    <a href="/upload_file/hapus/{{ $file->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection