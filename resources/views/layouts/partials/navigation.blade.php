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
                    <a class="nav-link {{ request()->routeIs('ibu_hamil.log') ? 'active' : '' }}"
                        href="{{ route('ibu_hamil.log') }}">
                        <i class="fa-regular fa-file-alt me-1"></i> Log
                    </a>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item-text">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="small text-muted">{{ Auth::user()->email }}</div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
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
        <a class="text-center nav-link {{ request()->routeIs('ibu_hamil.log') ? 'text-pink' : 'text-muted' }}"
            href="{{ route('ibu_hamil.log') }}">
            <i class="fas fa-file-alt"></i><br><small>Log</small>
        </a>

        {{-- Profile icon --}}
        <a href="#" class="text-center nav-link text-muted" data-bs-toggle="modal" data-bs-target="#profileModal">
            <i class="fas fa-user"></i><br><small>Profile</small>
        </a>
    </div>
</nav>

{{-- Modal Profile --}}
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-2">
                    <strong>{{ Auth::user()->name }}</strong>
                </div>
                <div class="mb-3 text-muted small">{{ Auth::user()->email }}</div>
                <div class="d-grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


