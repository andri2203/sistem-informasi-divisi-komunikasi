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
</head>

<body>
    <main id="main" class="wrapper">
        <aside id="sidebar" class="sidebar-main bg-primary">
            <header class="brand text-white ">
                Administrator Menu
            </header>
            <ul class="sidebar-nav">
                <li class="nav-menu single">
                    <i class="fa-solid fa-home me-2 icon"></i><a href="/admin" class="menu-link">Beranda</a>
                </li>
                <li class="nav-menu main">
                    <i class="fa-solid fa-database me-2"></i><span class="menu-header">Master Data</span>
                    <ul class="nav-sub">
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/barang" class="menu-link">Barang</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/servis-barang" class="menu-link">Servis Barang</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/barang-masuk" class="menu-link">Barang Masuk</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/barang-keluar" class="menu-link">Barang Keluar</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/pegawai" class="menu-link">Pegawai</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-menu main">
                    <i class="fa-solid fa-print me-2"></i><span class="menu-header">Master Laporan</span>
                    <ul class="nav-sub">
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i>
                            <a href="/admin/laporan" class="menu-link">Laporan Perbulan</a>
                        </li>
                        <li class="nav-submenu">
                            <i class="fa-solid fa-angle-right me-2 icon"></i>
                            <a href="/admin/stok-barang" class="menu-link">Laporan Stok Barang</a>
                        </li>
                    </ul>
                </li>
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
                        <li><a class="dropdown-item" href="/admin/ganti-password">Ganti Password</a></li>
                        <form action="/auth/logout" method="post">
                            @csrf
                            <li><button class="dropdown-item" type="submit">Keluar</button></li>
                        </form>
                    </ul>
                </div>
            </nav>
            <section class="page container-fluid">
                @yield("adminContent")
            </section>
            <footer class="content-footer">
                <span>&copy; 2022 All right reserved</span>
            </footer>
        </div>
    </main>

    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/fontawesome/js/all.min.js"></script>
</body>

</html>