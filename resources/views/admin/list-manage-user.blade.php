@extends("layouts.dashboard")

@section("dashboard")
<h3 class="text-bold text-center mb-4">Daftar User Dishub Kodim IM</h3>

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

<table class="table table-bordered">
    <thead>
        <tr class="table-dark">
            <th scope="col" width="20">#</th>
            <th scope="col" width="300">Nama</th>
            <th scope="col" width="100">Username</th>
            <th scope="col" width="100">Email</th>
            <th scope="col">NIP</th>
            <th scope="col">Gol</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Dibuat</th>
            <th scope="col" width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach($employees as $employee)
        <tr>
            <th scope="row">{{ $i++ }}</th>
            <td>{{ $employee->nama }}</td>
            <td>{{ $employee->username }}</td>
            <td>{{ $employee->email }}</td>
            <td>{{ $employee->nip }}</td>
            <td>{{ $employee->gol }}</td>
            <td>{{ $employee->jabatan }}</td>
            <td>{{ date('d M Y, h:m:s', strtotime($employee->created_at)) }}</td>
            <td class="text-center">
                @if($employee->role == 1 || $employee->pimpinan == 1)
                <a @if($employee->id == auth()->user()->id) href="/profil" @else href="/manage/pegawai/{{ $employee->id_pegawai }}" @endif class="btn btn-sm btn-info"><i class="fa-solid fa-user"></i> Profil</a>
                @else
                <a href="/manage/user/hapus/{{ $employee->id }}" class="btn btn-sm btn-danger">Hapus Akses</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endSection