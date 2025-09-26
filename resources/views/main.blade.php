<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Monitoring Mrj</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing_page_mrj/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page_mrj/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page_mrj/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page_mrj/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page_mrj/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page_mrj/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('landing_page_mrj/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header py-2 sticky-top">
        <div class="container d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('landing_page_mrj/assets/img/logo2.png') }}" alt="Logo Ibu Hamil">
                <h2 class="sitename ms-2">Ibu Hamil</h2>
            </a>

            <!-- Navigation -->
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Auth Buttons -->
            @if (Route::has('login'))
                <div class="auth-buttons d-flex align-items-center">
                    @auth
                        <a href="{{ url('/ibu-hamil/dashboard') }}" class="btn btn-accent">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-accent me-2">
                            <i class="fas fa-sign-in-alt me-1"></i> Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-accent">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </header>


    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="5000">

                <div class="carousel-item active">
                    <img src="{{ asset('landing_page_mrj/assets/img/hero-carousel/hero-carousel-1.jpg') }}"
                        alt="">
                    <div class="container">
                        <h2>Selamat Datang di Sistem Monitoring Kehamilan</h2>
                        <p>Platform digital untuk membantu ibu hamil, pengelola, dan tenaga kesehatan dalam memantau
                            kesehatan ibu hamil serta distribusi Tablet Tambah Darah (TTD/MRJ).</p>
                        <a href="#about" class="btn-get-started">Lihat Selengkapnya</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="{{ asset('landing_page_mrj/assets/img/hero-carousel/hero-carousel-2.jpg') }}"
                        alt="">
                    <div class="container">
                        <h2>Dukungan Asupan Gizi Ibu Hamil</h2>
                        <p>Dapatkan pengingat konsumsi Tablet Tambah Darah (MRJ) secara rutin agar kehamilan tetap sehat
                            dan terhindar dari risiko anemia.</p>
                        <a href="#about" class="btn-get-started">Lihat Selengkapnya</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src="{{ asset('landing_page_mrj/assets/img/hero-carousel/hero-carousel-3.jpg') }}"
                        alt="">
                    <div class="container">
                        <h2>Pantau, Ingatkan, dan Edukasi</h2>
                        <p>Dilengkapi dengan fitur monitoring, reminder konsumsi MRJ, dan konten edukasi untuk
                            meningkatkan pengetahuan ibu hamil serta mendukung peran pengelola.</p>
                        <a href="#about" class="btn-get-started">Lihat Selengkapnya</a>
                    </div>
                </div><!-- End Carousel Item -->

                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>

                <ol class="carousel-indicators"></ol>

            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">
            <div class="container">
                <div class="row gy-4">

                    <!-- Monitoring Kehamilan -->
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-baby icon"></i></div>
                            <h4><a href="#" class="stretched-link">Monitoring Kehamilan</a></h4>
                            <p>Pantau kondisi ibu hamil secara berkala melalui data pemeriksaan kesehatan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Reminder MRJ -->
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-bell icon"></i></div>
                            <h4><a href="#" class="stretched-link">Reminder MRJ</a></h4>
                            <p>Ingatkan konsumsi Tablet Tambah Darah (MRJ) agar kehamilan tetap sehat.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Edukasi Ibu Hamil -->
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-book-open icon"></i></div>
                            <h4><a href="#" class="stretched-link">Edukasi Kesehatan</a></h4>
                            <p>Akses konten edukasi berupa ebook, video, dan poster seputar kehamilan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Laporan & Statistik -->
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-chart-line icon"></i></div>
                            <h4><a href="#" class="stretched-link">Laporan & Statistik</a></h4>
                            <p>Visualisasi data pemeriksaan dan distribusi MRJ untuk pengambilan keputusan.</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>
            </div>
        </section>
        <!-- /Featured Services Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section accent-background">
            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <h3>Ayo Mulai Pantau Kehamilan dengan Mudah</h3>
                            <p>
                                Dengan aplikasi ini, Anda dapat memantau kesehatan ibu hamil,
                                mengatur reminder MRJ, dan mengakses edukasi seputar kehamilan.
                            </p>
                            <div class="cta-buttons mt-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-accent">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Buka Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-accent">
                                        Masuk ke Aplikasi
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /Call To Action Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Aplikasi MRJ</h2>
                <p>Sahabat digital ibu hamil dalam memantau kesehatan kehamilan dan konsumsi Tablet Tambah Darah (MRJ).
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('landing_page_mrj/assets/img/about.jpg') }}" class="img-fluid"
                            alt="">
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox pulsating-play-btn"></a>
                    </div>
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Aplikasi Monitoring Kehamilan & Konsumsi MRJ</h3>
                        <p class="fst-italic">
                            Kami membantu ibu hamil, kader, dan tenaga kesehatan dalam memantau kesehatan ibu secara
                            digital dan lebih mudah.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Pencatatan pemeriksaan kehamilan secara
                                    teratur.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Pengingat konsumsi tablet MRJ agar kesehatan ibu
                                    tetap terjaga.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Akses cepat ke konten edukasi kesehatan ibu dan
                                    janin.</span></li>
                        </ul>
                        <p>
                            Dengan aplikasi ini, diharapkan ibu hamil dapat lebih terkontrol kesehatannya, kader lebih
                            mudah memantau,
                            dan dosen/tenaga kesehatan dapat melakukan analisis data dengan lebih akurat.
                        </p>
                    </div>
                </div>

            </div>

        </section>
        <!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Aplikasi MRJ hadir untuk mendukung kesehatan ibu hamil melalui layanan digital yang mudah digunakan.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Monitoring Kehamilan</h3>
                            </a>
                            <p>Pencatatan rutin tinggi badan, berat badan, tekanan darah, dan Hb untuk memantau kondisi
                                ibu hamil.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-pills"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Konsumsi MRJ</h3>
                            </a>
                            <p>Membantu ibu hamil mengingat jadwal konsumsi tablet tambah darah agar tetap sehat
                                sepanjang kehamilan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Reminder</h3>
                            </a>
                            <p>Pengingat otomatis untuk pemeriksaan dan konsumsi MRJ agar tidak terlewat.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Edukasi Kesehatan</h3>
                            </a>
                            <p>Kumpulan ebook, video, dan poster digital yang bisa diakses oleh ibu hamil untuk
                                meningkatkan pengetahuan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Analisis Data</h3>
                            </a>
                            <p>Kader dan dosen dapat memantau perkembangan kesehatan ibu secara menyeluruh melalui
                                dashboard Filament.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Dukungan Komunitas</h3>
                            </a>
                            <p>Kolaborasi antara ibu hamil, kader, dan tenaga kesehatan untuk saling mendukung demi
                                kesehatan ibu dan bayi.</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section>
        <!-- /Services Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimoni</h2>
                <p>Suara mereka yang telah merasakan manfaat aplikasi MRJ</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                    data-breakpoints='{ "320": { "slidesPerView": 1, "spaceBetween": 40 }, "1200": { "slidesPerView": 3, "spaceBetween": 20 } }'>

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Sejak pakai aplikasi ini, saya jadi tidak pernah lupa minum tablet tambah
                                        darah. Jadwal pemeriksaan juga lebih teratur.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('landing_page_mrj/assets/img/testimonials/testimonials-1.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Siti Aisyah</h3>
                                <h4>Ibu Hamil</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Saya terbantu memantau ibu hamil di wilayah saya. Semua data tersimpan rapi
                                        dan bisa saya akses kapan saja.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('landing_page_mrj/assets/img/testimonials/testimonials-2.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Lina Putri</h3>
                                <h4>Kader Posyandu</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>Dari sisi akademik, aplikasi ini membantu kami mendapatkan data real-time yang
                                        bisa dianalisis untuk penelitian.</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('landing_page_mrj/assets/img/testimonials/testimonials-3.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Dr. Ahmad</h3>
                                <h4>Dosen Kesehatan</h4>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak Kami</h2>
                <p>Hubungi kami untuk informasi lebih lanjut mengenai aplikasi Monitoring Kehamilan & MRJ.</p>
            </div><!-- End Section Title -->

            <!-- Google Maps -->
            <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                <iframe style="border:0; width: 100%; height: 370px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d721.7367603115686!2d120.20912873259248!3d-3.026570923787669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d915f0480d7a9df%3A0x6479153cec82cac3!2sPuskesmas%20Wara%20Selatan!5e1!3m2!1sid!2sid!4v1758806402061!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="row gy-4">

                            <div class="col-lg-12">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Puskesmas Wara Selatan, Palopo, Sulawesi Selatan</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Telepon</h3>
                                    <p>+62 852 1234 5678</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email</h3>
                                    <p>support@mrjapp.id</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nama Anda" required>
                                </div>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Email Anda" required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subjek"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Pesan Anda" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading...</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Pesan Anda berhasil terkirim. Terima kasih!</div>

                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>
            </div>
        </section>
        <!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">

                <!-- Tentang Aplikasi -->
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="/" class="logo d-flex align-items-center">
                        <span class="sitename">MRJ App</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Puskesmas Wara Selatan</p>
                        <p>Palopo, Sulawesi Selatan</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>+62 852 1234 5678</span></p>
                        <p><strong>Email:</strong> <span>support@mrjapp.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Navigasi Cepat -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#hero">Beranda</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#services">Layanan</a></li>
                        <li><a href="#contact">Kontak</a></li>
                        <li><a href="/login">Login</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan Kami</h4>
                    <ul>
                        <li><a href="#">Monitoring Kehamilan</a></li>
                        <li><a href="#">Pengingat Jadwal</a></li>
                        <li><a href="#">Edukasi Kesehatan</a></li>
                        <li><a href="#">Konsultasi Online</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>2025</span> <strong class="px-1 sitename">MRJ App</strong> <span>— Semua Hak Dilindungi</span>
            </p>
        </div>

    </footer>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing_page_mrj/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_page_mrj/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('landing_page_mrj/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('landing_page_mrj/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing_page_mrj/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('landing_page_mrj/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('landing_page_mrj/assets/js/main.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper('.init-swiper', {
                loop: true,
                speed: 600,
                autoplay: {
                    delay: 5000,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 40
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            });
        });
    </script>


</body>

</html>
