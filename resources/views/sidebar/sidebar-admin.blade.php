<li class="nav-menu main {{ Request::is('admin/berita*')?'open':'' }}">
    <a href="#berita" class="d-flex justify-content-between btn-x">
        <div class="menu-header"><i class="fa-solid fa-newspaper me-2"></i>Berita</div>
        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
    </a>
    <ul class="nav-sub" id="berita">
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/berita" class="menu-link">Tambah Berita</a>
        </li>
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/berita/list" class="menu-link">Kelola Berita</a>
        </li>
    </ul>
</li>

<li class="nav-menu main {{ Request::is('manage*')?'open':'' }}">
    <a href="#user-manajemen" class="d-flex justify-content-between btn-x">
        <div class="menu-header"><i class="fa-solid fa-user-plus me-2"></i>Manajemen User</div>
        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
    </a>
    <ul class="nav-sub" id="user-manajemen">
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/manage/user" class="menu-link">Tambah User</a>
        </li>
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/manage/user-list" class="menu-link">Daftar user</a>
        </li>
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/manage/pegawai" class="menu-link">Pegawai</a>
        </li>
    </ul>
</li>

<li class="nav-menu main {{ Request::is('admin*')?'open':'' }}">
    <a href="#barang" class="d-flex justify-content-between btn-x">
        <div class="menu-header"><i class="fa-solid fa-database me-2"></i>Master Data</div>
        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
    </a>
    <ul class="nav-sub" id="barang">
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
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/admin/file" class="menu-link">File Upload</a>
        </li>
    </ul>
</li>

<li class="nav-menu main">
    <a href="#laporan" class="d-flex justify-content-between btn-x">
        <div class="menu-header"><i class="fa-solid fa-print me-2"></i>Master Laporan</div>
        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
    </a>
    <ul class="nav-sub" id="laporan">
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