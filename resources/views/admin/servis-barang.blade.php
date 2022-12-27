@extends("layouts.admin")

@section("adminContent")
<h3 class="text-bold text-center mb-4">Servis Barang</h3>

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

<div class="d-flex justify-content-center">
    <form action="/admin/servis-barang/{{ $id_servis_barang??'' }}" method="POST" class="w-75">
        @csrf
        <div class="row mb-3">
            <label for="kodeBarang" class="col-sm-2 col-form-label">Barang</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select" name="id_barang" autofocus required>
                    <option value="">Pilih Barang</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}" @if($itemServis !=null && $item->id == old('id_barang', $itemServis->id_barang)) selected @endif>
                        {{ $item->nm_barang }} / {{ $item->mrk_barang }} / {{ $item->tahun_barang }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="jumlahBarang" class="col-sm-2 col-form-label">Jumlah Barang</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="jumlahBarang" name="jumlah_barang" placeholder="Jumlah Barang di Servis" required value="@if($itemServis !=null){{ old('jumlah_barang', $itemServis->jumlah_barang) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="kondisiBarang" class="col-sm-2 col-form-label">Kondisi Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kondisiBarang" name="kondisi_barang" placeholder="Kondisi Barang" required value="@if($itemServis !=null){{ old('kondisi_barang', $itemServis->kondisi_barang) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggalMasuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggalMasuk" name="tgl_masuk" placeholder="Tanggal Masuk" required value="@if($itemServis !=null){{ old('tgl_masuk', $itemServis->tgl_masuk) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggalServis" class="col-sm-2 col-form-label">Tanggal Servis</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggalServis" name="tgl_servis" placeholder="Tanggal Servis" required value="@if($itemServis !=null){{ old('tgl_servis', $itemServis->tgl_servis) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggalKeluar" class="col-sm-2 col-form-label">Tanggal Keluar</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggalKeluar" name="tgl_keluar" placeholder="Tanggal Keluar Servis" required value="@if($itemServis !=null){{ old('tgl_keluar', $itemServis->tgl_keluar) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="statusServis" class="col-sm-2 col-form-label">Status Servis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="statusServis" name="status_servis" placeholder="Status Servis" required value="@if($itemServis !=null){{ old('status_servis', $itemServis->status_servis) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jenisServis" class="col-sm-2 col-form-label">Jenis Servis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="jenisServis" name="jenis_servis" placeholder="Jenis Servis" required value="@if($itemServis !=null){{ old('jenis_servis', $itemServis->jenis_servis) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="hargaServis" class="col-sm-2 col-form-label">Harga Servis</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="hargaServis" name="harga_servis" placeholder="Harga Servis" required value="@if($itemServis !=null){{ old('harga_servis', $itemServis->harga_servis) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">@if($itemServis !=null){{ old('keterangan', $itemServis->keterangan) }}@endif</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col">
                <div class="btn-group mt-3 mx-auto" role="group" aria-label="Basic example">
                    @if($id_servis_barang == null)
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
@endSection