<li class="nav-menu single">
    <i class="fa-solid fa-bell me-2 icon"></i><a href="/pengumuman" class="menu-link">Pengumuman</a>
</li>

@if(auth()->user()->role == 2)
@php
$emp = \App\Models\Employee::find(auth()->user()->id_pegawai)
@endphp
<li class="nav-menu single">
    <i class="fa-solid fa-list me-2 icon"></i><a href="/informasi" class="menu-link">Informasi</a>
</li>

@if(!$emp || $emp->pimpinan != 1)
<li class="nav-menu main {{ Request::is('upload_file*')?'open':'' }}">
    <a href="#upload" class="d-flex justify-content-between btn-x">
        <div class="menu-header"><i class="fa-solid fa-file me-2"></i>Upload File</div>
        <div><i class="fa-solid fa-angle-right me-3 ic"></i></div>
    </a>
    <ul class="nav-sub" id="upload">
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/upload_file/tambah" class="menu-link">Upload File</a>
        </li>
        <li class="nav-submenu">
            <i class="fa-solid fa-angle-right me-2 icon"></i><a href="/upload_file" class="menu-link">Kelola File</a>
        </li>
    </ul>
</li>
@endif
@endif