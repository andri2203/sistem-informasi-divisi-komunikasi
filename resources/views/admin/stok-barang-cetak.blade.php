@extends("layouts.cetak")

@section("adminCetak")
<div class="w-100 mt-2 mb-2">
    <div class="d-flex w-100">
        <div style="width: 120px;">Kode Barang</div>: {{ $barang->kd_barang }}
    </div>
    <div class="d-flex w-100">
        <div style="width: 120px;">Nama Barang</div>: {{ $barang->nm_barang }}
    </div>
    <div class="d-flex w-100">
        <div style="width: 120px;">Merek Barang</div>: {{ $barang->mrk_barang }}
    </div>
    <div class="d-flex w-100">
        <div style="width: 120px;">Tahun Barang</div>: {{ $barang->tahun_barang }}
    </div>
    <div class="d-flex w-100">
        <div style="width: 120px;">Jumlah Awal</div>: {{ $barang->jml_barang }}
    </div>
    <div class="d-flex w-100">
        <div style="width: 120px;">Keterangan</div>: {{ $barang->keterangan }}
    </div>
</div>

<table class="table table-bordered mx-0 mt-3">
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
</table>
@endSection