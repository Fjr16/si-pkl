<aside id="sidebar" class="sidebar">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            <span class="d-none d-lg-block">SI-PKL</span>
        </a>
    </div><!-- End Logo -->

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/*') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-heading">Data Master</li>

        @can('admin')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('user*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                <i class="bi bi-people"></i>
                <span>Data User</span>
            </a>
        </li>
        @endcan

        @canany(['guru', 'admin'])
        <li class="nav-item">
            <a class="nav-link {{ Request::is('guru*') ? '' : 'collapsed' }}" href="{{ route('guru.index') }}">
                <i class="bi bi-person"></i>
                <span>Data Guru</span>
            </a>
        </li>
        @endcanany

        @canany(['dudi', 'admin'])
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dudi*') ? '' : 'collapsed' }}" href="{{ route('dudi.index') }}">
                <i class="bi bi-building"></i>
                <span>Data DUDI</span>
            </a>
        </li>
        @endcanany

        @canany(['siswa', 'admin'])
        <li class="nav-item">
            <a class="nav-link {{ Request::is('siswa*') ? '' : 'collapsed' }}" href="{{ route('siswa.index') }}">
                <i class="bi bi-mortarboard"></i>
                <span>Data Siswa</span>
            </a>
        </li>
        @endcanany
            
        @can('admin')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('jurusan*') ? '' : 'collapsed' }}" href="{{ route('jurusan.index') }}">
                <i class="bi bi-stack"></i>
                <span>Data Jurusan</span>
            </a>
        </li>
        @endcan

        <li class="nav-heading">Praktek Kerja Lapangan</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('data/pkl*') ? '' : 'collapsed' }}" href="{{ route('data/pkl/siswa.index') }}">
                <i class="bi bi-archive"></i>
                <span>Data PKL</span>
            </a>
        </li>

        @can('siswa')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('absensi*') ? '' : 'collapsed' }}" href="{{ route('absensi/siswa.index') }}">
                <i class="bi bi-calendar2-check"></i>
                <span>Presensi Siswa</span>
            </a>
        </li>
        @endcan

        @can('guru')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('monitoring*') ? '' : 'collapsed' }}" href="{{ route('monitoring/guru.index') }}">
                    <i class="bi bi-tv"></i>
                    <span>Monitoring</span>
                </a>
            </li>
        @endcan

        @can('siswa')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('jurnal*') ? '' : 'collapsed' }}" href="{{ route('jurnal/harian.index') }}">
                <i class="bi bi-journal-check"></i>
                <span>Jurnal Harian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('laporan/akhir*') ? '' : 'collapsed' }}" href="{{ route('laporan/akhir.create') }}">
                <i class="bi bi-journals"></i>
                <span>Laporan Akhir</span>
            </a>
        </li>
        @endcan

        @canany(['dudi', 'guru', 'siswa'])
            <li class="nav-item">
                <a class="nav-link {{ Request::is('sertifikat*') ? '' : 'collapsed' }}" href="{{ route('sertifikat.index') }}">
                    <i class="bi bi-patch-check"></i>
                    <span>Sertifikat</span>
                </a>
            </li>
        @endcanany

        <li class="nav-heading">Lainnya </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dokumen*') ? '' : 'collapsed' }}" href="{{ route('dokumen.index') }}">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                <span>Dokumen</span>
            </a>
        </li>

    </ul>

</aside>
