{{-- Desktop Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top d-none d-md-block">
    <div class="container">
        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('ibu_hamil.dashboard') }}">
            <div class="p-2 rounded me-2" style="background: linear-gradient(to right, #ec4899, #8b5cf6)">
                <i class="fas fa-baby text-white"></i>
            </div>
            <span class="fw-bold text-dark">Ibu Hamil Care</span>
        </a>

        {{-- Menu --}}
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item px-3">
                    <a class="nav-link font {{ request()->routeIs('ibu_hamil.dashboard') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.dashboard') }}">
                        <i class="fa-regular fa-house me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.education') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.education') }}">
                        <i class="fas fa-book-open me-1"></i> Edukasi
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.monitoring') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.monitoring') }}">
                        <i class="fas fa-heartbeat me-1"></i> Monitoring
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.mrj') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.mrj') }}">
                        <i class="fas fa-pills me-1"></i> MRJ
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.log') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.log') }}">
                        <i class="fa-regular fa-file-alt me-1"></i> Log
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.profile') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.profile') }}">
                        <i class="fa-regular fa-user me-1"></i> Profil

                    </a>
                </li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link class="nav-link" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                  </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Mobile Bottom Navbar --}}
<nav class="navbar fixed-bottom navbar-light bg-white border-top d-md-none">
    <div class="container d-flex justify-content-around py-1">
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.dashboard') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.dashboard') }}">
            <i class="fas fa-home"></i><br><small>Beranda</small>
        </a>
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.education') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.education') }}">
            <i class="fas fa-book-open"></i><br><small>Edukasi</small>
        </a>
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.monitoring') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.monitoring') }}">
            <i class="fas fa-heartbeat"></i><br><small>Monitoring</small>
        </a>
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.mrj') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.mrj') }}">
            <i class="fas fa-pills"></i><br><small>MRJ</small>
        </a>
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.log') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.log') }}">
            <i class="fas fa-file-alt"></i><br><small>Log</small>
        </a>
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.profile') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.profile') }}">
            <i class="fas fa-user"></i><br><small>Profil</small>
        </a>
    </div>
</nav>
