@extends("layouts.admin")

@section("adminContent")
<h3 class="text-bold text-center mb-4">Data Barang</h3>

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

<div class="d-flex align-items-center flex-column">
    <form action="/admin/barang/{{ $id_barang??'' }}" method="POST" class="w-75 mb-4">
        @csrf
        <div class="row mb-3">
            <label for="kodeBarang" class="col-sm-2 col-form-label">Kode Barang</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="kodeBarang" name="kd_barang" placeholder="Kode Barang" autofocus required value="{{ old('kd_barang', $item->kd_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="namaBarang" name="nm_barang" placeholder="Nama Barang" required value="{{ old('nm_barang', $item->nm_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="merek" class="col-sm-2 col-form-label">Merek</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="merek" name="mrk_barang" placeholder="Merek" required value="{{ old('mrk_barang', $item->mrk_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" id="jumlah" name="jml_barang" placeholder="Jumlah" required value="{{ old('jml_barang', $item->jml_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" id="tahun" name="tahun_barang" placeholder="Tahun" required value="{{ old('tahun_barang', $item->tahun_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="harga" class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" id="harga" name="harga_barang" placeholder="Harga Beli" required value="{{ old('harga_barang', $item->harga_barang??'') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $item->keterangan??'') }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col">
                <div class="btn-group mt-3 mx-auto" role="group" aria-label="Basic example">
                    @if($id_barang == null)
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="reset">Reset</button>
                    @else
                    <button class="btn btn-success" type="submit">Ubah</button>
                    <button class="btn btn-warning" type="reset">Reset</button>
                    <a href="/admin/barang" class="btn btn-danger">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary text-center">
                <th>#</th>
                <th width="150">Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th width="30">Tahun</th>
                <th width="30">Jumlah</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th width="30">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($items as $barang)
            <tr class="table-light">
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $barang->kd_barang }}</td>
                <td>{{ $barang->nm_barang }}</td>
                <td>{{ $barang->mrk_barang }}</td>
                <td class="text-center">{{ $barang->tahun_barang }}</td>
                <td class="text-center">{{ $barang->jml_barang }}</td>
                <td>Rp. {{ number_format($barang->harga_barang, 2, ",", ".") }}</td>
                <td>{{ $barang->keterangan }}</td>
                <td>
                    <div class="btn-group">
                        <a href="/admin/barang/{{ $barang->id }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i></a>
                        <a href="/admin/barang/hapus/{{ $barang->id }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endSection