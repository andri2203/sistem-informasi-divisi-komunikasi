<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>Sistem Infromasi Divisi Komunikasi</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/layouts/admin.css">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    @yield("dashboard-head")
</head>

<body>
    <main id="main" class="wrapper">
        <aside id="sidebar" class="sidebar-main bg-primary">
            <header class="brand text-white">DISHUB IM</header>
            <ul class="sidebar-nav">
                <li class="nav-menu single">
                    <i class="fa-solid fa-home me-2 icon"></i><a href="/dashboard" class="menu-link">Beranda</a>
                </li>

                <li class="nav-menu main {{ Request::is('profil*')?'open':'' }}">
                    <a href="#berita" class="d-flex justify-content-between btn-x">
                        <div class="menu-header"><i class="fa-solid fa-user me-2"></i>Profil</div>
                        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
                    </a>
                    <ul class="nav-sub" id="berita">
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/profil" class="menu-link">Data Diri</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/profil/ganti-password" class="menu-link">Ganti Password</a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->role == 1)
                @include('sidebar.sidebar-admin')
                @else
                @include('sidebar.sidebar-user')
                @endif
            </ul>
        </aside>
        <div id="content" class="content">
            <nav class="main-nav shadow-sm">
                <header class="brand">
                    <img src="/images/PUSHUB_AD.png" alt="Logo PUSHUB TNI AD" class="image-brand me-2">
                    Sistem Informasi Divisi Komunikasi
                </header>
                <div class="dropdown d-flex align-items-center">
                    <a class="btn btn-white btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Selamat Datang, {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu">
                        <form action="/auth/logout" method="post">
                            @csrf
                            <li><button class="dropdown-item" type="submit">Keluar</button></li>
                        </form>
                    </ul>
                </div>
            </nav>
            <section class="page container-fluid">
                @yield("dashboard")
            </section>
            <footer class="content-footer">
                <span>&copy; 2022 All right reserved</span>
            </footer>
        </div>
    </main>

    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
    <script src="/js/layouts/dashboard.js"></script>
    <script src="/js/layouts/profil.js"></script>
    @yield("dashboard-script")
</body>

</html>