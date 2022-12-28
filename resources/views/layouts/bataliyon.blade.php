<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Bataliyon</title>

    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/css/layouts/home.css">
</head>

<body>
    <main class="d-flex flex-column min-vh-100 bg-own">
        <nav class="navbar navbar-expand navbar-own-dark bg-dark px-3">
            <a class="navbar-brand" href="#">
                <img src="/images/PUSHUB_AD.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                <span class="fw-bold">Halaman Utama Divisi - Bataliyon</span>
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/bataliyon/upload-file">Upload File</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/bataliyon/informasi">Informasi</a>
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

        <footer class="clearfix px-1 py-2 bg-dark"></footer>
    </main>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
</body>

</html>