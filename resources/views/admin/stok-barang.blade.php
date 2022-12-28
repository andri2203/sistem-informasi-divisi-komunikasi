@extends("layouts.admin")

@section("adminContent")
<h3 class="fw-bold text-center mb-4">Stok Barang</h3>

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

<div class="d-flex flex-column align-items-center">
    <form action="/admin/stok-barang" method="POST" class="row g-3">
        @csrf
        <div class="col-auto">
            <label for="barang" class="visually-hidden">Barang</label>
            <select name="barang" id="barang" class="form-select">
                <option value="">-- Pilih Barang --</option>
                @foreach($items as $item) <option @if($id_barang && $id_barang==$item->id || old('barang') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nm_barang }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <label for="periode" class="visually-hidden">Periode</label>
            <input type="month" class="form-control" id="periode" name="periode" value="{{ old('periode', $periode) }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Lihat</button>
        </div>
    </form>
    @if($is_data)
    <div class="w-100 mt-2 mb-2">
        <div class="row mb-1">
            <div class="col-sm-2">Kode Barang</div>
            <div class="col"> : {{ $barang->kd_barang }}</div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-2">Nama Barang</div>
            <div class="col"> : {{ $barang->nm_barang }}</div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-2">Merek Barang</div>
            <div class="col"> : {{ $barang->mrk_barang }}</div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-2">Tahun Barang</div>
            <div class="col"> : {{ $barang->tahun_barang }}</div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-2">Jumlah Awal</div>
            <div class="col"> : {{ $barang->jml_barang }}</div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-2">Keterangan</div>
            <div class="col"> : {{ $barang->keterangan }}</div>
        </div>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="align-middle text-center" width="30">#</th>
                <th class="align-middle text-center" width="150">Tanggal</th>
                <th class="align-middle text-center" width="100">status</th>
                <th class="align-middle text-center">Keterangan</th>
                <th class="align-middle text-center" width="100">Barang Masuk</th>
                <th class="align-middle text-center" width="100">Barang Keluar</th>
                <th class="align-middle text-center" width="100">Total Barang</th>
            </tr>
        </thead>
        <tbody>
            @if(!$is_data)
        <tbody>
            <tr>
                <td class="text-center" colspan="7">Silahkan Pilih Barang</td>
            </tr>
        </tbody>
        @else
        @php
        $i = 1;
        $totalBarang = $barang->jml_barang;

        @endphp
        <tbody>
            @foreach($distribusi as $d)
            @php
            $totalBarang = $d->status == "masuk"? $totalBarang + $d->jumlah_barang:$totalBarang - $d->jumlah_barang;
            @endphp
            <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $d->tanggal }}</td>
                <td class="text-uppercase">{{ $d->status }}</td>
                <td>{{ $d->kondisi_barang }}</td>
                <td class="text-end">{{ $d->status == "masuk"? $d->jumlah_barang:"" }}</td>
                <td class="text-end">{{ $d->status == "keluar"? "-".$d->jumlah_barang:"" }}</td>
                <td class="text-end fw-bold">{{ $totalBarang }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end fw-bold" colspan="6">Total Barang</td>
                <td class="text-end fw-bold">{{ $totalBarang }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>
@endSection