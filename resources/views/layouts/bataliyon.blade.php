<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Bataliyon | {{ $title }}</title>

    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/layouts/home.css">
</head>

<body>
    <main class="d-flex flex-column min-vh-100 h-100 bg-own">
        <nav class="navbar navbar-expand navbar-own-dark bg-dark px-3">
            <a class="navbar-brand" href="#">
                <img src="/images/PUSHUB_AD.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                <span class="fw-bold">Halaman Utama Divisi - Bataliyon</span>
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link @if($active == 'profil') active @endif" aria-current="page" href="/bataliyon">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'upload') active @endif" aria-current="page" href="/bataliyon/upload-file">Upload File</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'informasi') active @endif" aria-current="page" href="/bataliyon/informasi">Informasi</a>
                </li>
            </ul>
            <div class="dropdown ms-auto">
                <a class="btn btn-outline-own-2 dropdown-toggle" id="btn-login" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user me-2"></i>{{ auth()->user()->name }}
                </a>

                <ul class="dropdown-menu">
                    <form action="/auth/logout" method="post">
                        @csrf
                        <li><button class="dropdown-item" type="submit"><i class="fa-solid fa-sign-out me-2"></i>Keluar</button></li>
                    </form>
                </ul>
            </div>
        </nav>

        <section class="my-2 container">
            <h4 class="fw-bold text-center border-bottom py-2 border-dark mb-4">{{ $title }}</h4>
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('bataliyon')
        </section>

        <footer class="clearfix px-1 py-2 bg-dark text-white align-middle mt-auto">
            Copyright &copy; {{ date("Y") }}. All Right Reserved.
        </footer>
    </main>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
    <script src="/js/layouts/bataliyon.js"></script>
</body>

</html>