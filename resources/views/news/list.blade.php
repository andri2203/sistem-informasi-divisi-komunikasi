@extends("layouts.dashboard")

@section("dashboard")
<h2 class="text-bold mb-4">Kelola Berita</h2>

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


<table class="table table-bordered bg-white">
    <thead>
        <tr class="table-dark">
            <th scope="col" width="20" class="text-center">#</th>
            <th scope="col" class="text-center">Header</th>
            <th scope="col" class="text-center">Link</th>
            <th scope="col" width="130" class="text-center">Type</th>
            <th scope="col" width="130" class="text-center">Create At</th>
            <th scope="col" width="130" class="text-center">Update At</th>
            <th scope="col" width="50" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp

        @foreach($data as $d)
        <tr>
            <th class="align-middle" scope="row">{{ $i++ }}</th>
            <td class="fw-bolder align-middle">{{ $d->header }}</td>
            <td class="text-center align-middle"><a href="/berita/baca/{{ $d->slug }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-eye"></i> Lihat</a></td>
            <td class="align-middle">{{ $d->type }}</td>
            <td>{{ $d->created_at }}</td>
            <td>{{ $d->updated_at }}</td>
            <td>
                <div class="btn-group">
                    <a href="/admin/berita/{{ $d->id }}" target="_blank" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                    <a href="/admin/berita/hapus/{{ $d->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection