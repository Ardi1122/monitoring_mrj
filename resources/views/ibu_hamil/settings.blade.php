@extends('layouts.ibu_hamil')

@section('content')
<div class="pb-5">
    <!-- Header -->
    <div class="profile-header rounded-3 p-4 text-white mb-4">
        <h1 class="h2 fw-bold mb-2">Profil Saya</h1>
        <p class="header-subtitle">Kelola informasi pribadi dan pengaturan akun</p>
    </div>

    <div class="row g-4">
        <!-- Main Content (Left Side) -->
        <div class="col-lg-8">
            <!-- Personal Information -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="fas fa-user text-rose me-2"></i>
                            Informasi Pribadi
                        </h5>
                        <button class="btn btn-rose btn-sm">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="fas fa-edit me-1"></i>
                                <span id="btnText">Edit</span>
                            </a> 
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- View Mode -->
                    <div id="viewMode">
                        <div class="d-flex align-items-center mb-4">
                            <div class="profile-avatar">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h3 class="h4 fw-bold mb-1">{{ $user->name }}</h3>
                                <p class="text-muted mb-0">{{ $user->identitas->tanggal_lahir ? \Carbon\Carbon::parse($user->identitas->tanggal_lahir)->age . ' tahun' : '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-muted me-3"></i>
                                    <div>
                                        <p class="small text-muted mb-1">Telepon</p>
                                        <p class="fw-medium mb-0">{{ $user->identitas->nomor_telepon ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-muted me-3"></i>
                                    <div>
                                        <p class="small text-muted mb-1">Alamat</p>
                                        <p class="fw-medium mb-0">{{ $user->identitas->alamat ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  
                </div>
            </div>

            <!-- Pregnancy Information -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title d-flex align-items-center mb-0">
                        <i class="fas fa-baby text-pink me-2"></i>
                        Informasi Kehamilan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="pregnancy-info-item">
                                <span class="text-muted">Usia Kehamilan</span>
                                <span class="fw-semibold">{{ $monitoring->usia_kehamilan }}</span>
                                
                            </div>
                            <div class="pregnancy-info-item">
                                <span class="text-muted">Trimester</span>
                        <span class="fw-semibold">{{ $trimester ?? '-' }}</span>
                            </div>
                            <div class="pregnancy-info-item">
                                <span class="text-muted">Perkiraan Lahir</span>
                                <span class="fw-semibold">{{ $perkiraanLahir }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Metrics -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title d-flex align-items-center mb-0">
                        <i class="fas fa-heartbeat text-danger me-2"></i>
                        Metrik Kesehatan Terkini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="health-metric bg-primary-light text-center">
                                <p class="small text-muted mb-2">Berat Badan</p>
                                <p class="h4 fw-bold text-primary mb-0">{{ $monitoring->berat_badan ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="health-metric bg-success-light text-center">
                                <p class="small text-muted mb-2">LILA</p>
                                <p class="h4 fw-bold text-success mb-0">{{ $monitoring->lila ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="health-metric bg-danger-light text-center">
                                <p class="small text-muted mb-2">Hemoglobin</p>
                                <p class="h4 fw-bold text-danger mb-0">{{ $monitoring->hb ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="health-metric bg-purple-light text-center">
                                <p class="small text-muted mb-2">Tekanan Darah</p>
                                <p class="h4 fw-bold text-purple mb-0">{{ $monitoring->tekanan_darah_sistolik ?? '-' }}/{{ $monitoring->tekanan_darah_diastolik ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar (Right Side) -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title mb-0">Ringkasan</h5>
                </div>
                <div class="card-body">
                    <div class="quick-stat-item">
                        <span class="small text-muted">Status KEK</span>
                        <span class="badge bg-success-light text-success">Normal</span>
                    </div>
                    <div class="quick-stat-item">
                        <span class="small text-muted">Total Konseling</span>
                        <span class="fw-semibold">3 sesi</span>
                    </div>
                    <div class="quick-stat-item">
                        <span class="small text-muted">Konseling Terakhir</span>
                        <span class="fw-semibold">20 Sep 2024</span>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title d-flex align-items-center mb-0">
                        <i class="fas fa-cog text-secondary me-2"></i>
                        Pengaturan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary text-start">
                            <i class="fas fa-bell me-2"></i>
                            Pengaturan Notifikasi
                        </button>
                        <button class="btn btn-outline-secondary text-start">
                            <i class="fas fa-shield-alt me-2"></i>
                            Privasi & Keamanan
                        </button>
                        <button class="btn btn-outline-secondary text-start">
                            <i class="fas fa-key me-2"></i>
                            Ubah Password
                        </button>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="card border-0 shadow-lg emergency-card">
                <div class="card-header border-bottom" style="background-color: #fee2e2;">
                    <h5 class="card-title mb-0 text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Kontak Darurat
                    </h5>
                </div>
                <div class="card-body" style="background-color: #fef2f2;">
                    <div class="mb-3">
                        <p class="small fw-medium mb-1">Puskesmas Setempat</p>
                        <p class="small text-muted mb-0">
                            <i class="fas fa-phone me-1"></i>
                            0211-1234567
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="small fw-medium mb-1">Bidan Koordinator</p>
                        <p class="small text-muted mb-0">
                            <i class="fas fa-phone me-1"></i>
                            0812-3456789
                        </p>
                    </div>
                    <button class="btn btn-danger w-100 btn-sm">
                        <i class="fas fa-phone-alt me-1"></i>
                        Hubungi Darurat
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Colors */
:root {
    --rose-color: #f43f5e;
    --pink-color: #ec4899;
    --purple-color: #8b5cf6;
}

.text-rose {
    color: var(--rose-color) !important;
}

.text-pink {
    color: var(--pink-color) !important;
}

.text-purple {
    color: var(--purple-color) !important;
}

.btn-rose {
    background-color: var(--rose-color);
    border-color: var(--rose-color);
    color: white;
}

.btn-rose:hover {
    background-color: #e11d48;
    border-color: #e11d48;
    color: white;
}

/* Header Gradient */
.profile-header {
    background: linear-gradient(135deg, var(--rose-color) 0%, var(--pink-color) 100%);
    box-shadow: 0 10px 25px rgba(244, 63, 94, 0.15);
}

.header-subtitle {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 0;
}

/* Profile Avatar */
.profile-avatar {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #fda4af 0%, #f9a8d4 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Cards */
.card {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Pregnancy Info Item */
.pregnancy-info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.pregnancy-info-item:last-child {
    border-bottom: none;
}

/* Badge Styles */
.bg-pink-light {
    background-color: rgba(236, 72, 153, 0.1);
}

.bg-success-light {
    background-color: rgba(34, 197, 94, 0.1);
}

.bg-primary-light {
    background-color: rgba(59, 130, 246, 0.1);
}

.bg-danger-light {
    background-color: rgba(239, 68, 68, 0.1);
}

.bg-purple-light {
    background-color: rgba(139, 92, 246, 0.1);
}

/* Health Metrics */
.health-metric {
    padding: 1.25rem;
    border-radius: 0.75rem;
    transition: transform 0.2s ease;
}

.health-metric:hover {
    transform: translateY(-2px);
}

/* Quick Stats */
.quick-stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.quick-stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

/* Form Controls */
.form-control:focus,
.form-select:focus {
    border-color: var(--rose-color);
    box-shadow: 0 0 0 0.2rem rgba(244, 63, 94, 0.25);
}

/* Emergency Card */
.emergency-card {
    border: 2px solid #fecaca;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-avatar {
        width: 60px;
        height: 60px;
    }
    
    .profile-avatar i {
        font-size: 1.5rem;
    }
    
    .health-metric {
        padding: 1rem;
    }
    
    .health-metric .h4 {
        font-size: 1.25rem;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 1rem !important;
    }
}
</style>

<!-- Font Awesome untuk icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection