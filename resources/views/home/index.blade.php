<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Divisi Komunikasi</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/layouts/home.css">
</head>

<body>
    <main class="d-flex flex-column min-vh-100 bg-light">
        <nav id="navbar" class="navbar navbar-expand navbar-own bg-transparent px-5 py-3 fixed-top" style="transition: all 0.4s ease-in-out;">
            <div class="d-flex justify-content-between w-100">
                <a class="navbar-brand fw-bold" href="/">Divisi Komunikasi</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white" style="gap: 10px;">
                    <li class="nav-item">
                        <a id="btn-home" class="nav-link scroll active" aria-current="page" type="button" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a id="btn-profil" class="nav-link scroll" type="button" href="#profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a id="btn-pengumuman" class="nav-link scroll" type="button" href="#pengumuman">Pengumuman</a>
                    </li>
                </ul>
                @auth()
                <div class="dropdown">
                    <a class="btn btn-outline-own dropdown-toggle btn-own-js" id="btn-auth" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user me-2"></i>{{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard">Beranda</a></li>
                        <li><a class="dropdown-item" href="/profil">Profil</a></li>
                        <form action="/auth/logout" method="post">
                            @csrf
                            <li><button class="dropdown-item" type="submit">Keluar</button></li>
                        </form>
                    </ul>
                </div>
                @else
                <a id="btn-login" href="/auth/login" class="btn btn-sm btn-outline-own px-3 pt-2 me-2 btn-own-js" style="transition: all 0.3s ease-in-out;">
                    <i class="fa-solid fa-user me-2"></i>Masuk
                </a>
                <a id="btn-register" href="/auth/register" class="btn btn-sm btn-outline-own px-3 pt-2 btn-own-js" style="transition: all 0.3s ease-in-out;">
                    <i class="fa-solid fa-user-plus me-2"></i>Daftar
                </a>
                @endauth
            </div>
        </nav>
        <section id="home" class="min-vh-100 scroll-targets bg-own overflow-hidden">
            <div class="row g-2 my-5 pt-5 px-5 justify-content-between">
                <div class="col-sm-7 py-5">
                    <h1 class="text-own fw-bold text-uppercase" style="font-size: 7ch;">Selamat Datang Di</h1>
                    <h3 class="text-own-2 fw-bolder text-uppercase">Sistem Informasi Devisi Komunikasi</h3>
                    <h3 class="text-own-2 fw-bolder text-uppercase mb-5">Hubdam IM</h3>

                    <p class="text-own-3 fw-bolder w-75 mt-2 mb-5 h6">
                        Sistem Informasi ini berisi Informasi Barang Keluar dari setiap Bataliyon yang terdaftar didalam sistem
                    </p>

                    @auth()
                    <a href="/dashboard" class="btn btn-lg btn-outline-own mt-1">Dashboard</a>
                    @else
                    <div class="d-flex mt-1">
                        <a href="/auth/login" class="btn btn-lg btn-outline-own me-3"><i class="fa-solid fa-user me-2"></i>Masuk</a>
                        <a href="/auth/register" class="btn btn-lg btn-outline-own"><i class="fa-solid fa-user-plus me-2"></i>Daftar</a>
                    </div>
                    @endauth
                </div>
                <div class="col-sm-4">
                    <img src="/images/PUSHUB_AD.png" class="img-fluid w-100">
                </div>
            </div>
        </section>

        <section id="profil" class="min-vh-100 bg-own-green scroll-targets">
            <div class="my-4 mx-3 p-5 row">
                <div class="col-sm-5 text-center">
                    <img src="@if($pimpinan) {{ asset('storage/'. $pimpinan->image) }} @else /image/no-user.jpg @endif" alt="{{ $pimpinan->nama??'' }}" class="img-fluid" style="width: 25vw;">
                    <h3 class="text-white fw-bolder mt-2">{{ $pimpinan->nama??'' }}</h3>
                    <h5 class="text-white fw-bolder mt-1">{{ $pimpinan->gol ??''}} / {{ $pimpinan->jabatan??'' }}</h5>
                    <h6 class="text-white fw-bolder mt-1">Nip. {{ $pimpinan->nip??'' }}</h6>
                </div>
                <div class="col-sm-7">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-indicators">
                            @for($j = 0; $j < count($profil); $j++) <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $j }}" @if($j==0) class="active" aria-current="true" @endif aria-label="Slide " {{ $j }}"></button>
                                @endfor
                        </div>
                        <div class="carousel-inner">
                            @php $i = 0; @endphp
                            @foreach($profil as $pr)
                            <div class="carousel-item @if($i == 0) active @endif">
                                <img src="{{ asset('storage/'. $pr->image) }}" class="d-block w-100" alt="{{ $pr->header }}">
                                <div class="carousel-caption d-none d-md-block rounded" style="background-color: rgba(0, 0, 0, 0.7);">
                                    <h5>{{ $pr->header }}</h5>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($pr->body), 100) }}</p>
                                    <a href="/berita/baca/{{ $pr->slug }}" class="btn btn-sm btn-outline-light" target="_blank">Selengkapnya</a>
                                </div>
                            </div>
                            @php $i++; @endphp
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="pengumuman" class="min-vh-100 bg-own scroll-targets px-3 pt-5 pb-2 d-flex flex-column align-item-center justify-content-between">
            <h3 class="fw-bold text-own-2 text-center my-3 pb-3 border-dark border-bottom">Pengumuman</h3>
            <div class="row">
                @php $i = 0; @endphp
                @foreach($pengumuman as $pr)
                <div class="col-sm-3">
                    <div class="card">
                        <img src="{{ asset('storage/'. $pr->image) }}" class="card-img-left" alt="{{ $pr->header }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pr->header }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($pr->body), 50) }}</p>
                            <a href="/berita/baca/{{ $pr->slug }}" class="btn btn-sm btn-outline-primary" target="_blank">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
            <div class="text-center my-3 pt-3 border-dark border-top">
                <a href="/berita/pengumuman" class="btn btn-outline-own">Selengkapnya</a>
            </div>
        </section>
        <footer class="clearfix px-1 py-2 bg-dark text-white align-middle">
            <i class="fa-solid fa-copyright me-2"></i>{{ date("Y") }}. All Right Reserved.
        </footer>
    </main>

    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
    <script src="/js/layouts/home.js"></script>
</body>

</html>