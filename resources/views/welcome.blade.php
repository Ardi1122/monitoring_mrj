<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiMoni KEK - Sistem Monitoring KEK Ibu Hamil</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:%23ffffff;stop-opacity:0.1"/><stop offset="100%" style="stop-color:%23ffffff;stop-opacity:0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>') no-repeat;
            background-size: cover;
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .btn-masuk {
            background: linear-gradient(45deg, #ff6b6b, #ffa726);
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
        }
        
        .btn-masuk:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.4);
            color: white;
        }
        
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            margin: 20px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: none;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 30px;
            color: white;
        }
        
        .section-title {
            color: #2c3e50;
            margin-bottom: 60px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #ff6b6b, #ffa726);
            border-radius: 2px;
        }
        
        .stats-card {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin: 15px 0;
        }
        
        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .about-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 100px 0;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 50px 0 30px;
        }
        
        .logo-text {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .subtitle {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: rgba(0,0,0,0.1); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">SiMoni KEK</a>
            
            @if (Route::has('login'))
                <div class="navbar-nav ms-auto">
                    @auth
                        <a class="nav-link text-white" href="{{ url('/dashboard') }}" style="transition: all 0.3s;">
                            <i class="fas fa-tachometer-alt me-1"></i>
                            Dashboard
                        </a>
                    @else
                        <a class="nav-link text-white me-3" href="{{ route('login') }}" style="transition: all 0.3s;">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            Log in
                        </a>
                        
                        @if (Route::has('register'))
                            <a class="nav-link text-white" href="{{ route('register') }}" style="transition: all 0.3s;">
                                <i class="fas fa-user-plus me-1"></i>
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container hero-content">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <h1 class="logo-text mb-4">SiMoni KEK</h1>
                    <p class="subtitle">Sistem Monitoring Kekurangan Energi Kronis pada Ibu Hamil</p>
                    <p class="text-white-50 fs-5 mb-5">
                        Platform digital untuk pemberdayaan kader kesehatan dalam pencegahan KEK 
                        melalui edukasi, monitoring, dan inovasi nutrisi MRJ (Moringa-Rosella-Jaggery).
                    </p>
                    
                    <!-- Tombol Masuk di tengah banner -->
                    <div class="text-center text-lg-start">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-masuk">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-masuk">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Masuk ke Aplikasi
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image">
                        <i class="fas fa-heartbeat" style="font-size: 15rem; color: rgba(255,255,255,0.2);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title display-4 fw-bold text-start">Tentang SiMoni KEK</h2>
                    {{-- <p class="lead text-muted mb-4">
                        Aplikasi monitoring yang mendukung program pemberdayaan kader berbasis coaching 
                        dalam pencegahan KEK pada ibu hamil melalui inovasi nutrisi MRJ.
                    </p> --}}
                    <p class="text-muted mb-4">
                        SiMoni KEK (Sistem Monitoring Kekurangan Energi Kronis) hadir sebagai solusi digital 
                        untuk meningkatkan kualitas pelayanan kesehatan ibu hamil di tingkat posyandu. 
                        Dengan menggabungkan teknologi modern dan pendekatan coaching, aplikasi ini 
                        membantu kader kesehatan dalam melakukan edukasi gizi yang lebih efektif.
                    </p>
                    <p class="text-muted mb-5">
                        Program ini mengintegrasikan inovasi nutrisi MRJ (Moringa-Rosella-Jaggery) 
                        sebagai suplemen alami yang kaya akan zat besi, protein, dan vitamin untuk 
                        mencegah dan mengatasi masalah KEK pada ibu hamil.
                    </p>
                </div>
                <div class="col-lg-6 text-center">
                    <div style="position: relative;">
                        <div style="background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 20px; padding: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                            <i class="fas fa-pregnant" style="font-size: 8rem; color: white; opacity: 0.9; margin-bottom: 20px;"></i>
                            <div style="background: rgba(255,255,255,0.1); border-radius: 10px; padding: 20px; backdrop-filter: blur(10px);">
                                <h4 class="text-white fw-bold mb-3">Fokus Utama</h4>
                                <div class="row text-white">
                                    <div class="col-6">
                                        <i class="fas fa-shield-alt fa-2x mb-2"></i>
                                        <p class="mb-0 small">Pencegahan KEK</p>
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <p class="mb-0 small">Pemberdayaan Kader</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">100+</div>
                        <p class="mb-0">Kader Terdaftar</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">500+</div>
                        <p class="mb-0">Ibu Hamil</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number">50+</div>
                        <p class="mb-0">Posyandu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title display-4 fw-bold">Fitur Utama</h2>
                    <p class="lead text-muted">Solusi lengkap untuk monitoring dan edukasi gizi ibu hamil</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Edukasi</h4>
                        <p class="text-muted">
                            Modul edukasi digital, video pembelajaran, dan materi coaching 
                            untuk meningkatkan kompetensi kesehatan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Monitoring Gizi</h4>
                        <p class="text-muted">
                            Pemantauan LILA, berat badan, hemoglobin, dan konsumsi MRJ 
                            dengan visualisasi grafik yang mudah dipahami.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Logbook Digital</h4>
                        <p class="text-muted">
                            Pencatatan digital pertemuan coaching dan dokumentasi berkelanjutan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h4 class="fw-bold mb-3">MRJ Tracker</h4>
                        <p class="text-muted">
                            Pelacakan produksi dan distribusi produk MRJ (Moringa-Rosella-Jaggery) 
                            dengan reminder stok otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Benefits Section -->
    <section class="py-5" style="background: white;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title display-5 fw-bold text-start">Manfaat Program</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <strong>Pencegahan KEK:</strong> Deteksi dini dan pencegahan kekurangan energi kronis pada ibu hamil
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <strong>Pemberdayaan Kader:</strong> Meningkatkan kompetensi kader melalui coaching berkelanjutan
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <strong>Inovasi Nutrisi:</strong> Pemanfaatan MRJ sebagai suplemen alami untuk ibu hamil
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <strong>Monitoring Digital:</strong> Pemantauan status gizi secara real-time dan terstruktur
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <strong>Evidence-Based:</strong> Pengambilan keputusan berdasarkan data dan analisis
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-mother-child" style="font-size: 12rem; color: #667eea; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Target Users Section -->
    <section class="py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title display-4 fw-bold">Pengguna Sistem</h2>
                    <p class="lead text-muted">Aplikasi dirancang untuk mendukung berbagai stakeholder</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kader Posyandu</h4>
                        <p class="text-muted">
                            Input data ibu hamil, catatan coaching, distribusi MRJ, 
                            dan akses materi edukasi untuk meningkatkan kompetensi.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Ibu Hamil</h4>
                        <p class="text-muted">
                            Akses informasi gizi, reminder konsumsi MRJ, 
                            log kehamilan sederhana, dan monitoring perkembangan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Puskesmas & Tim Pengusul</h4>
                        <p class="text-muted">
                            Dashboard monitoring capaian, evaluasi intervensi, 
                            analisis data, dan laporan komprehensif program.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-3">SiMoni KEK</h4>
                    <p class="text-light">
                        Aplikasi monitoring untuk program pemberdayaan kader berbasis coaching 
                        dalam pencegahan KEK pada ibu hamil melalui inovasi nutrisi MRJ.
                    </p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Fitur</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Edukasi Kader</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Monitoring Gizi</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Logbook Digital</a></li>
                        <li><a href="#" class="text-light text-decoration-none">MRJ Tracker</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Dukungan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Panduan Pengguna</a></li>
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Kontak Support</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Pelatihan</a></li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <p class="mb-0 text-light">&copy; 2024 SiMoni KEK. Semua hak dilindungi.</p>
                </div>
                <div class="col-lg-6 text-end">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>