@extends("layouts.dashboard")

@section("dashboard")
<h3 class="fw-bold text-center mb-4">Informasi</h3>

<form action="/informasi/show" method="post" class="card mb-3">
    @csrf
    <div class="card-body">
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-2">
                <h6 class="fw-bolder">Informasi Barang</h6>
            </div>
            <div class="col-sm-3">
                <div class="">
                    <label for="laporan" class="form-label">Laporan :</label>
                    <select name="laporan" id="laporan" class="form-select">
                        @for($i = 0; $i < count($laporan); $i++) <option value="{{ $i }}" @if(isset($indexLaporan) && $i==$indexLaporan) selected @endif>{{ $laporan[$i] }}</option>
                            @endfor
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="">
                    <label for="periode" class="form-label">Periode :</label>
                    <input type="month" class="form-control" id="periode" name="periode" value="{{$periode??''}}" required>
                </div>
            </div>
            <div class="col-sm-1">
                <button type="submit" class="btn btn-primary">Lihat</button>
            </div>
        </div>
    </div>
</form>

@if(isset($data))
<div class="btn-group mb-2">
    <a href="/informasi" class="btn btn-success"><i class="fa-solid fa-angle-left"></i> Kembali</a>
    <a href="/informasi/{{ $indexLaporan }}/{{ $bulan }}/{{ $tahun }}/cetak" target="_blank" class="btn btn-primary"><i class="fa-solid fa-print"></i> Cetak</a>
</div>
<div style="overflow-x: scroll;">
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th scope="col" width="30">#</th>
                @foreach($data['head'] as $head)
                <th scope="col" class="text-center align-middle" style="min-width: 200px;">{{ $head }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @if(count($data['body']) == 0)
            <td colspan="{{ count($data['head']) + 1 }}" class="text-center fw-bolder">Belum Ada Data Di Periode {{ date('F Y', strtotime($periode)) }}</td>
            @else
            @foreach($data['body'] as $body)
            <tr>
                <th scope="row">{{ $i++ }}</th>
                @for($j = 0; $j < count($data['head']); $j++) <td>{{ $body[$i][$j] }}</td>
                    @endfor
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endif

@endsection