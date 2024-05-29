<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(Auth::user()->Super())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('super.dashboard') }}">
                <i class="mdi mdi-application menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.indexUser') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Management User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('super.indexKategori') }}">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Kategori Obat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('super.superobat') }}">
                <i class="mdi mdi-mdi mdi-apps menu-icon"></i>
                <span class="menu-title">Daftar Obat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="mdi mdi-archive menu-icon"></i>
                <span class="menu-title">Transaksi</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
<!-- End of Sidebar -->