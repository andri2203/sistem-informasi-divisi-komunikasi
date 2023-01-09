<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->header }}</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/layouts/home.css">
</head>

<body>
    <main class="d-flex flex-column min-vh-100 ">
        <nav id="navbar" class="navbar navbar-expand navbar-own bg-own px-4 shadow-sm fixed-top" style="transition: all 0.4s ease-in-out;">
            <div class="d-flex justify-content-between w-100">
                <a class="navbar-brand fw-bold" href="/">Divisi Komunikasi</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white" style="gap: 10px;">
                    <li class="nav-item">
                        <a id="btn-home" class="nav-link" aria-current="page" type="button" href="/">Home</a>
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
        <section class="container py-3 w-75" style="margin-top: 56px; min-height: calc(100vh - 56px);">
            @yield('news')
        </section>
        <footer class="clearfix px-1 py-2 bg-dark text-white align-middle">
            <i class="fa-solid fa-copyright me-2"></i>{{ date("Y") }}. All Right Reserved.
        </footer>
    </main>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
    @yield("dashboard-script")
</body>

</html>