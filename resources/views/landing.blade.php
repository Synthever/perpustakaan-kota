<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Kota Yogyakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --dark-blue: #1e3a8a;
        }
        
        * {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-brand i {
            font-size: 2rem;
        }
        
        .nav-link {
            color: #334155 !important;
            font-weight: 500;
            margin: 0 15px;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--secondary-blue) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: var(--secondary-blue);
            transition: all 0.3s;
            transform: translateX(-50%);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            right: -150px;
            animation: float 6s ease-in-out infinite;
        }
        
        .hero::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .hero p {
            font-size: 1.3rem;
            opacity: 0.95;
            margin-bottom: 30px;
        }
        
        .hero-image {
            position: relative;
            z-index: 2;
            animation: float 4s ease-in-out infinite;
        }
        
        .hero-image img {
            max-width: 100%;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
        }

        /* Button Styles */
        .btn-primary-custom {
            background: white;
            color: var(--primary-blue);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: var(--primary-blue);
        }
        
        .btn-outline-custom {
            background: transparent;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid white;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-blue);
            transform: translateY(-5px);
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: #f8fafc;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            width: 60%;
            height: 4px;
            background: var(--secondary-blue);
            bottom: -10px;
            left: 20%;
            border-radius: 2px;
        }
        
        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s;
            height: 100%;
            border: 2px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(30, 64, 175, 0.2);
            border-color: var(--secondary-blue);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(30, 64, 175, 0.3);
        }
        
        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }
        
        .feature-desc {
            color: #64748b;
            line-height: 1.8;
        }

        /* Schedule Section */
        .schedule {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
        }
        
        .schedule-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }
        
        .schedule-card:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }
        
        .schedule-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        
        .schedule-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .schedule-time {
            font-size: 1.2rem;
            opacity: 0.95;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .schedule-time:last-child {
            border-bottom: none;
        }

        /* Location Section */
        .location {
            padding: 100px 0;
            background: white;
        }
        
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            height: 450px;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .location-info {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(30, 64, 175, 0.3);
            height: 100%;
        }
        
        .location-item {
            display: flex;
            align-items: start;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .location-item i {
            font-size: 2rem;
            opacity: 0.9;
        }
        
        .location-item h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .location-item p {
            opacity: 0.95;
            margin: 0;
            line-height: 1.8;
        }

        /* Statistics */
        .stats {
            padding: 80px 0;
            background: var(--light-blue);
        }
        
        .stat-card {
            text-align: center;
            padding: 30px;
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }
        
        .stat-label {
            font-size: 1.2rem;
            color: #64748b;
            font-weight: 600;
        }

        /* CTA Section */
        .cta {
            padding: 100px 0;
            background: linear-gradient(135deg, #0f172a 0%, var(--primary-blue) 100%);
            color: white;
            text-align: center;
        }
        
        .cta h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .cta p {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        /* Footer */
        .footer {
            background: #0f172a;
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        
        .footer-link:hover {
            color: white;
            padding-left: 10px;
        }
        
        .social-icons a {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: all 0.3s;
            font-size: 1.2rem;
        }
        
        .social-icons a:hover {
            background: var(--secondary-blue);
            transform: translateY(-5px);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-on-scroll {
            opacity: 0;
            animation: fadeInUp 0.8s forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .location-info {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-book-fill"></i>
                <span>Perpustakaan Kota Yogyakarta</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Jam Buka</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location">Lokasi</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1>Selamat Datang di<br>Perpustakaan Kota Yogyakarta</h1>
                    <p>Membaca adalah jendela dunia. Temukan ribuan koleksi buku, jurnal, dan literatur digital yang siap memperkaya pengetahuan Anda.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom">
                            <i class="bi bi-person-plus"></i>
                            Daftar Gratis
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-custom">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image" data-aos="fade-left">
                    <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                        <!-- Ilustrasi Perpustakaan -->
                        <rect x="50" y="100" width="400" height="250" fill="#ffffff" rx="10"/>
                        <rect x="50" y="100" width="400" height="50" fill="#3b82f6" rx="10" ry="0"/>
                        <!-- Buku-buku -->
                        <rect x="80" y="180" width="40" height="120" fill="#ef4444" rx="3"/>
                        <rect x="130" y="190" width="40" height="110" fill="#3b82f6" rx="3"/>
                        <rect x="180" y="170" width="40" height="130" fill="#10b981" rx="3"/>
                        <rect x="230" y="185" width="40" height="115" fill="#f59e0b" rx="3"/>
                        <rect x="280" y="175" width="40" height="125" fill="#8b5cf6" rx="3"/>
                        <rect x="330" y="195" width="40" height="105" fill="#ec4899" rx="3"/>
                        <rect x="380" y="180" width="40" height="120" fill="#14b8a6" rx="3"/>
                        <!-- Orang membaca -->
                        <circle cx="250" cy="320" r="30" fill="#1e40af"/>
                        <rect x="230" y="350" width="40" height="50" fill="#1e40af" rx="5"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-card">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Koleksi Buku</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">5K+</div>
                        <div class="stat-label">Anggota Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">15K+</div>
                        <div class="stat-label">Peminjaman/Tahun</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Kunjungan/Hari</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="text-muted fs-5 mt-4">Berbagai layanan yang kami sediakan untuk kenyamanan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-book"></i>
                        </div>
                        <h3 class="feature-title">Peminjaman Buku</h3>
                        <p class="feature-desc">Pinjam buku favorit Anda dengan mudah dan cepat. Proses peminjaman yang efisien dengan sistem digital terintegrasi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3 class="feature-title">Booking Online</h3>
                        <p class="feature-desc">Reservasi buku secara online sebelum Anda datang. Sistem booking yang memudahkan Anda merencanakan kunjungan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-tablet"></i>
                        </div>
                        <h3 class="feature-title">E-Library</h3>
                        <p class="feature-desc">Akses ribuan koleksi digital, e-book, jurnal ilmiah, dan literatur online kapan saja dan dimana saja.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="feature-title">Ruang Baca</h3>
                        <p class="feature-desc">Ruang baca yang nyaman dan tenang dengan fasilitas AC, WiFi gratis, dan pencahayaan yang baik.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="feature-title">Internet Corner</h3>
                        <p class="feature-desc">Fasilitas komputer dan internet gratis untuk keperluan riset, tugas, atau browsing informasi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                        <h3 class="feature-title">Referensi & Konsultasi</h3>
                        <p class="feature-desc">Layanan konsultasi dan bantuan pencarian referensi dari pustakawan profesional kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="schedule" id="schedule">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title text-white">Jam Operasional</h2>
                <p class="fs-5 mt-3" style="opacity: 0.9;">Kami melayani Anda dengan jadwal berikut</p>
            </div>
            <div class="row justify-content-center g-4">
                <div class="col-lg-5 col-md-6" data-aos="zoom-in" data-aos-delay="0">
                    <div class="schedule-card text-center">
                        <div class="schedule-icon">
                            <i class="bi bi-calendar-week"></i>
                        </div>
                        <h3 class="schedule-title">Senin - Kamis</h3>
                        <div class="schedule-time">
                            <i class="bi bi-clock me-2"></i>
                            <strong>07:00 - 17:00 WIB</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="schedule-card text-center">
                        <div class="schedule-icon">
                            <i class="bi bi-calendar-day"></i>
                        </div>
                        <h3 class="schedule-title">Jumat</h3>
                        <div class="schedule-time">
                            <i class="bi bi-clock me-2"></i>
                            <strong>07:00 - 11:00 WIB</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <p class="fs-5" style="opacity: 0.9;">
                    <i class="bi bi-info-circle me-2"></i>
                    Sabtu, Minggu & Hari Libur Nasional: <strong>TUTUP</strong>
                </p>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section class="location" id="location">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Lokasi Kami</h2>
                <p class="text-muted fs-5 mt-4">Temukan kami di pusat kota Yogyakarta</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0389!2d110.3847!3d-7.8167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDknMDAuMSJTIDExMMKwMjMnMDUuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="location-info">
                        <div class="location-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <h5>Alamat</h5>
                                <p>Jl. Manggis No.18, Pandeyan<br>Kec. Umbulharjo<br>Kota Yogyakarta, DIY 55161</p>
                            </div>
                        </div>
                        <div class="location-item">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <h5>Telepon</h5>
                                <p>(0274) 588 234<br>+62 812 3456 7890</p>
                            </div>
                        </div>
                        <div class="location-item">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <h5>Email</h5>
                                <p>info@perpusyogya.go.id<br>layanan@perpusyogya.go.id</p>
                            </div>
                        </div>
                        <div class="location-item">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <h5>Jam Operasional</h5>
                                <p>Senin - Kamis: 07:00 - 17:00<br>Jumat: 07:00 - 11:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container" data-aos="zoom-in">
            <h2>Siap Memulai Perjalanan Literasi Anda?</h2>
            <p>Daftar sekarang dan nikmati berbagai layanan perpustakaan kami</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-primary-custom btn-lg">
                    <i class="bi bi-person-plus"></i>
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-custom btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">
                        <i class="bi bi-book-fill me-2"></i>
                        Perpustakaan Kota Yogyakarta
                    </h4>
                    <p style="opacity: 0.8; line-height: 1.8;">
                        Perpustakaan modern yang menyediakan berbagai layanan literasi untuk masyarakat Kota Yogyakarta.
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h4 class="footer-title">Menu</h4>
                    <a href="#home" class="footer-link">Beranda</a>
                    <a href="#features" class="footer-link">Layanan</a>
                    <a href="#schedule" class="footer-link">Jam Buka</a>
                    <a href="#location" class="footer-link">Lokasi</a>
                    <a href="{{ route('register') }}" class="footer-link">Daftar</a>
                    <a href="{{ route('login') }}" class="footer-link">Login</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-title">Layanan</h4>
                    <a href="#" class="footer-link">Peminjaman Buku</a>
                    <a href="#" class="footer-link">Booking Online</a>
                    <a href="#" class="footer-link">E-Library</a>
                    <a href="#" class="footer-link">Keanggotaan</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-title">Kontak</h4>
                    <a href="#" class="footer-link">
                        <i class="bi bi-geo-alt me-2"></i>
                        Jl. Manggis No.18, Yogyakarta
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-telephone me-2"></i>
                        (0274) 588 234
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-envelope me-2"></i>
                        info@perpusyogya.go.id
                    </a>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 40px 0 20px;">
            <div class="text-center" style="opacity: 0.7;">
                <p class="mb-0">&copy; 2026 Perpustakaan Kota Yogyakarta. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
