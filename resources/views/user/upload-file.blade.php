@extends("layouts.dashboard")

@section("dashboard")
<h3 class="fw-bold text-center mb-4">Form Upload File</h3>

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

<div class="container">
    <div class="d-flex justify-content-center">
        <form @if($id_file==null) action="/upload_file/tambah" @else action="/upload_file/edit/{{ $id_file }}" @endif method="post" enctype="multipart/form-data">
            @csrf
            <p class="mb-3 fw-bolder">Catatan : Anda dapat mengirimkan File hanya dalam format Word, Excel & PDF</p>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <label for="keterangan" class="form-label fw-bolder">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan File" maxlength="250">{{ old('keterangan', $file->keterangan??'') }}</textarea>
                    @error('keterangan')
                    <div class=" invalid-feedback">{{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            @if($id_file!=null)
            <span class="d-inline-block">
                <p class="fw-bolder me-2 mb-1">File Sebelumnya</p>
                <p class="fst-italic">{{ $file->file }}</p>
            </span>
            @endif

            <div class="row mb-3">
                <div class="col-sm-8">
                    <label for="file" class="form-label fw-bolder">Pilih File</label>
                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                    @error('file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Upload File</button>
        </form>
    </div>
</div>
@endsection