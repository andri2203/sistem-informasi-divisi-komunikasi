@extends("layouts.dashboard")

@section("dashboard")
<h2 class="text-bold mb-4">Berita</h2>

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

<form action="/admin/berita{{ $id_berita!=null?'/'.$id_berita:'' }}" method="post" class="row g-3" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="header" class="form-label">Judul</label>
        <div class="input-group">
            <input type="text" name="header" id="header" class="form-control" value="{{ old('header', $news->header??'') }}" placeholder="Judul Berita">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 mb-3">
            <label for="slug" class="form-label">slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $news->slug??'') }}" placeholder="Slug" readonly>
        </div>

        <div class="col-sm-6 mb-3">
            <label for="type" class="form-label">Tipe Berita</label>
            <select name="type" id="type" class="form-control">
                @foreach($tipe as $tp)
                <option value="{{ $tp }}" @if(old('type', $news->type??'')==$tp) selected @endif>{{ $tp }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col-sm-4">
            <label for="image" class="form-label">Foto Judul Berita</label>
            <input type="file" name="image" id="image" class="form-control" onchange="imagePreview()">
        </div>
        <div class="col-sm-4">
            <img class="image-priview img-fluid" @if($id_berita) src="/files/{{ $news->image }}" @endif>
        </div>
    </div>


    <div class="mb-3">
        <input id="body" type="hidden" name="body" value="{{ old('body', $news->body??'') }}">
        <trix-editor input="body" class="form-control"></trix-editor>
    </div>

</form>

@endsection

@section("dashboard-head")
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

<style>
    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }
</style>
@endsection

@section("dashboard-script")
<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    });

    function imagePreview() {
        const image = document.querySelector('#image');
        const imagePreview = document.querySelector('.image-priview');

        imagePreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result;
        }
    }


    function createSlug(e) {
        const header = document.getElementById("header");
        const slug = document.getElementById("slug");

        e.preventDefault();

        var value = e.target.value;
        var slugValue = value.replaceAll(" ", "-");

        slug.value = slugValue.toLowerCase();
    }

    header.addEventListener("keyup", createSlug);
</script>
@endsection