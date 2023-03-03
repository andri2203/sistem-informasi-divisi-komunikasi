@extends("layouts.news")

@section("news")
<h3 class="fw-bolder text-own-2">{{ $berita->header }}</h3>
<div class="d-flex justify-content-between">
    <p class="text-own-2 mb-0">{{ date('d F Y, h:m:s', strtotime($berita->created_at)) }}</p>

    @if(auth()->user()->role == 1)
    <a href="/admin/berita/{{ $berita->id }}" class="btn btn-sm btn-success"><i class="fa-solid fa-edit"></i> Ubah</a>
    @endif
</div>
<hr class="mb-3">
<div class="d-flex justify-content-center px-5 mb-3">
    <img src="/files/{{ $berita->image }}" alt="{{ $berita->header }}" class="img-fluid w-50">
</div>
<div class="mb-3">
    {!! $berita->body !!}
</div>
@endsection