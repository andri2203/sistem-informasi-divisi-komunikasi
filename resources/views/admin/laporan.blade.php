@extends("layouts.admin")

@section("adminContent")
<h3 class="text-bold text-center mb-4">Laporan Perbulan</h3>

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
        <div class="d-flex justify-content-center align-items-center flex-column">
            <h4 class="card-title mb-3">Form Tampil Laporan</h4>
            <form action="/admin/laporan" method="POST" class="row g-3">
                @csrf
                <div class="col-auto">
                    <label for="laporan" class="visually-hidden">Laporan</label>
                    <select name="laporan" id="laporan" class="form-select" required>
                        <option value="">-- Pilih Laporan --</option>
                        @for($i = 0; $i < count($laporan); $i++) <option @if($i==$id_laporan && $id_laporan!=null) selected @endif value="{{ $i }}">{{ $laporan[$i] }}</option>
                            @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <label for="bulan" class="visually-hidden">Bulan</label>
                    <select name="bulan" id="bulan" class="form-select" required>
                        <option value="">-- Pilih Bulan --</option>
                        @for($i = 0; $i < count($bulan); $i++) <option @if($i==$id_bulan&& $id_bulan!=null) selected @endif value="{{ $i }}">{{ $bulan[$i] }}</option>
                            @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <label for="tahun" class="visually-hidden">Tahun</label>
                    <select name="tahun" id="tahun" class="form-select" required>
                        <option value="">-- Pilih Tahun --</option>
                        @for($i = date("Y"); $i > 2000; $i--)
                        <option @if($i==$id_tahun&& $id_tahun!=null) selected @endif value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Lihat Laporan</button>
                </div>
            </form>
        </div>
        @if($showTables)
        @php
        $head = $data['head'];
        $body = $data['body'];
        @endphp
        <hr class="mx-4 my-3">
        <h4 class="fw-bold text-center my-3">{{ $laporan[$id_laporan] }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    @for($i = 0; $i < count($head); $i++) <th scope="col">{{ $head[$i] }}</th> @endfor
                        <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1 @endphp
                @for($i = 0; $i < count($body); $i++) <tr>
                    <th scope="row">{{ $i + 1 }}</th>
                    @for($j = 0; $j <= count($head); $j++) @if($j==count($head)) <td>
                        <div class="btn-group">
                            <a href="{{ $body[$i][$j][0] }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                            <a href="{{ $body[$i][$j][1] }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </div>
                        </td>
                        @else
                        <td>{{ $body[$i][$j] }}</td>
                        @endif

                        @endfor
                        </tr>
                        @endfor
            </tbody>
        </table>
        @endif
    </div>
</div>
@endSection