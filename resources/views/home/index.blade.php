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
        <nav id="navbar" class="navbar navbar-expand navbar-own-dark bg-transparent px-5 py-3 fixed-top" style="transition: all 0.4s ease-in-out;">
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
                        <a id="btn-divisi" class="nav-link scroll" type="button" href="#divisi">Divisi</a>
                    </li>
                    <li class="nav-item">
                        <a id="btn-informasi" class="nav-link scroll" type="button" href="#informasi">Informasi</a>
                    </li>
                </ul>
                <button id="btn-login" class="btn btn-sm btn-outline-own-2 align-middle px-3" style="transition: all 0.3s ease-in-out;">
                    <i class="fa-solid fa-user me-2"></i>LOGIN
                </button>
            </div>
        </nav>
        <section id="home" class="min-vh-100 scroll-targets"></section>
        <section id="profil" class="min-vh-100 bg-own scroll-targets"></section>
        <section id="divisi" class="min-vh-100 bg-own-green scroll-targets"></section>
        <section id="informasi" class="min-vh-100 bg-own scroll-targets"></section>
    </main>

    <script src="/js/bootstrap/bootstrap.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
    <script src="/js/layouts/home.js"></script>
</body>

</html>