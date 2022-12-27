@extends("layouts.admin")

@section("adminContent")
<h3 class="text-bold text-center mb-4">Barang Masuk</h3>

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
    <form action="/admin/barang-masuk/{{ $id_distribusi_barang??'' }}" method="POST" class="w-75">
        @csrf
        <div class="row mb-3">
            <label for="kodeBarang" class="col-sm-2 col-form-label">Barang</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select" name="id_barang" autofocus required>
                    <option value="">Pilih Barang</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}" @if($distribusiBarang !=null && $item->id == old('id_barang', $distribusiBarang->id_barang)) selected @endif>
                        {{ $item->nm_barang }} / {{ $item->mrk_barang }} / {{ $item->tahun_barang }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="kondisiBarang" class="col-sm-2 col-form-label">Kondisi Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kondisiBarang" name="kondisi_barang" placeholder="Kondisi Barang" required value="@if($distribusiBarang !=null){{ old('kondisi_barang', $distribusiBarang->kondisi_barang) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="jumlahBarang" class="col-sm-2 col-form-label">Jumlah Barang</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="jumlahBarang" name="jumlah_barang" placeholder="Jumlah Barang Masuk" required value="@if($distribusiBarang !=null){{ old('jumlah_barang', $distribusiBarang->jumlah_barang) }}@endif">
            </div>
        </div>
        <div class="row mb-3">
            <label for="tanggalMasuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggalMasuk" name="tanggal" placeholder="Tanggal Masuk" required value="@if($distribusiBarang !=null){{ old('tanggal', $distribusiBarang->tanggal) }}@endif">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col">
                <div class="btn-group mt-3 mx-auto" role="group" aria-label="Basic example">
                    @if($id_distribusi_barang == null)
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