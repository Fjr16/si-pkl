<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('beranda') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">ArchiveSystem</span>
        </a>
        @if (Auth::user())
            @if (Auth::user()->role != 'User')
                <a href="{{ route('dashboard') }}" class="ms-auto btn btn-primary">
                    <span class="d-none d-lg-block">Dashboard</span>
                </a>
            @else
                <nav class="header-nav ms-auto">
                    <ul class="d-flex align-items-center">
                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile"
                                    class="rounded-circle">
                                <span
                                    class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name ?? 'User' }}</span>
                            </a><!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile"
                                        class="rounded-circle mb-3">
                                    <h6>{{ Auth::user()->name ?? 'User' }}</h6>
                                    <span>{{ Auth::user()->role ?? 'Role' }}</span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('login.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            @endif
        @else
            <a href="{{ route('login.index') }}" class="ms-auto btn btn-primary">
                <span class="d-none d-lg-block">Login</span>
            </a>
        @endif
    </div>

</header>
