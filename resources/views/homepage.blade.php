<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Penerimaan Peserta Didik Baru SD IT Baitul Ihsan - Sekolah Islam Terpadu dengan Kurikulum Berkualitas">
    <title>PPDB SD IT Baitul Ihsan - Tahun Ajaran 2025/2026</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Gradient Background */
        .hero-gradient {
            background: linear-gradient(135deg, #6d28d9 0%, #4f46e5 50%, #7c3aed 100%);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6d28d9 0%, #4f46e5 100%);
        }

        .gradient-soft {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .gradient-card {
            background: linear-gradient(135deg, rgba(109, 40, 217, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
        }

        /* Animations */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(109, 40, 217, 0.2);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Step Lines */
        .step-line {
            position: relative;
        }

        .step-line::after {
            content: '';
            position: absolute;
            top: 40px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #6d28d9, #4f46e5);
            z-index: -1;
        }

        /* Glass Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Custom Shadows */
        .shadow-glow {
            box-shadow: 0 0 30px rgba(109, 40, 217, 0.3);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .step-line::after {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }
        }

        /* Add these to the existing style tag */

        /* Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Bounce Animation */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        /* Pulse Animation */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        /* Button Hover Effects */
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }

        .btn-hover-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-hover-effect:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 20px 40px rgba(109, 40, 217, 0.15);
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-md shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div
                        class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">SD IT Baitul Ihsan</h1>
                        <p class="text-xs text-gray-500">Sekolah Islam Terpadu</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 font-medium transition">Beranda</a>
                    <a href="#profil" class="text-gray-700 hover:text-purple-600 font-medium transition">Profil</a>
                    <a href="#program" class="text-gray-700 hover:text-purple-600 font-medium transition">Program</a>
                    <a href="#informasi"
                        class="text-gray-700 hover:text-purple-600 font-medium transition">Informasi</a>
                    <a href="#kontak" class="text-gray-700 hover:text-purple-600 font-medium transition">Kontak</a>
                    <a href="{{ route('daftar.sekarang') }}"
                        class="gradient-bg text-white px-6 py-2.5 rounded-full font-semibold hover:opacity-90 transition shadow-lg hover:shadow-xl">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4">
                <a href="#beranda"
                    class="block py-3 text-gray-700 hover:text-purple-600 font-medium border-b">Beranda</a>
                <a href="#profil" class="block py-3 text-gray-700 hover:text-purple-600 font-medium border-b">Profil</a>
                <a href="#program"
                    class="block py-3 text-gray-700 hover:text-purple-600 font-medium border-b">Program</a>
                <a href="#informasi"
                    class="block py-3 text-gray-700 hover:text-purple-600 font-medium border-b">Informasi</a>
                <a href="#kontak" class="block py-3 text-gray-700 hover:text-purple-600 font-medium">Kontak</a>
                <a href="{{ route('daftar.sekarang') }}"
                    class="block mt-4 gradient-bg text-white px-6 py-3 rounded-full font-semibold text-center shadow-lg">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-24 hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-float"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <!-- Badge -->
                    <div class="inline-flex items-center glass-effect px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <p class="text-sm font-semibold">Tahun Ajaran 2025/2026</p>
                    </div>

                    <!-- Main Title -->
                    <h1 class="hero-title text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                        Penerimaan Peserta Didik Baru
                        <span class="block text-yellow-300 mt-4">SD IT Baitul Ihsan</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-lg md:text-xl mb-8 text-white/90 leading-relaxed">
                        "Mendidik Generasi Qurani dengan Pendekatan Islami Modern.
                        Membentuk Karakter Unggul, Berakhlak Mulia, dan Berprestasi."
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <a href="{{ route('daftar.sekarang') }}"
                            class="bg-white text-purple-700 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition-all duration-300 shadow-2xl hover:shadow-3xl text-center">
                            <i class="fas fa-graduation-cap mr-2"></i>Daftar Sekarang
                        </a>
                        <a href="#"
                            class="glass-effect text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/30 transition-all duration-300 border-2 border-white text-center">
                            <i class="fas fa-download mr-2"></i>Download Brosur
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 text-center">
                        <div class="glass-effect rounded-2xl p-4 hover-lift">
                            <h3 class="text-3xl font-bold text-yellow-300">500+</h3>
                            <p class="text-sm opacity-90">Siswa Aktif</p>
                        </div>
                        <div class="glass-effect rounded-2xl p-4 hover-lift">
                            <h3 class="text-3xl font-bold text-yellow-300">50+</h3>
                            <p class="text-sm opacity-90">Tenaga Pendidik</p>
                        </div>
                        <div class="glass-effect rounded-2xl p-4 hover-lift">
                            <h3 class="text-3xl font-bold text-yellow-300">A</h3>
                            <p class="text-sm opacity-90">Akreditasi</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="hidden md:block">
                    <div class="relative">
                        <div class="glass-effect rounded-3xl p-6 shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                alt="Siswa SD IT Baitul Ihsan" class="rounded-2xl shadow-xl w-full h-auto">
                        </div>
                        <!-- Notification Badge -->
                        <div
                            class="absolute -bottom-4 -left-4 bg-yellow-400 text-purple-900 p-5 rounded-2xl shadow-2xl max-w-xs border-2 border-white">
                            <div class="flex items-center">
                                <i class="fas fa-gift text-2xl mr-3"></i>
                                <div>
                                    <p class="font-bold text-lg">✨ Kuota Terbatas!</p>
                                    <p class="text-sm mt-1">Daftar sekarang dan dapatkan potongan biaya pendaftaran</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="#profil" class="text-white animate-bounce">
                <i class="fas fa-chevron-down text-2xl"></i>
            </a>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="order-2 md:order-1">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="SD IT Baitul Ihsan" class="rounded-3xl shadow-2xl w-full h-auto">
                        <div
                            class="absolute -bottom-6 -right-6 w-24 h-24 gradient-bg rounded-2xl flex items-center justify-center text-white text-4xl shadow-2xl">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="order-1 md:order-2">
                    <div
                        class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-full mb-6 text-sm font-semibold">
                        <i class="fas fa-info-circle mr-2"></i>
                        Tentang Kami
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        SD IT Baitul Ihsan
                    </h2>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                        SD IT Baitul Ihsan adalah sekolah Islam terpadu yang menggabungkan kurikulum nasional dengan
                        nilai-nilai Islam yang kuat. Kami berkomitmen untuk mencetak generasi Qurani yang berakhlak
                        mulia, cerdas, dan berprestasi.
                    </p>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Dengan metode pembelajaran yang interaktif dan menyenangkan, kami membentuk karakter siswa
                        menjadi insan yang bertakwa, berilmu, dan mampu menghadapi tantangan zaman.
                    </p>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="gradient-card p-5 rounded-xl hover-lift">
                            <div class="text-3xl mb-2 text-purple-600"><i class="fas fa-mosque"></i></div>
                            <h4 class="font-bold text-gray-900 mb-1">Berbasis Islam</h4>
                            <p class="text-sm text-gray-600">Pendidikan dengan nilai-nilai Islami</p>
                        </div>
                        <div class="gradient-card p-5 rounded-xl hover-lift">
                            <div class="text-3xl mb-2 text-purple-600"><i class="fas fa-book-open"></i></div>
                            <h4 class="font-bold text-gray-900 mb-1">Kurikulum Terintegrasi</h4>
                            <p class="text-sm text-gray-600">Nasional + Muatan Lokal</p>
                        </div>
                        <div class="gradient-card p-5 rounded-xl hover-lift">
                            <div class="text-3xl mb-2 text-purple-600"><i class="fas fa-chalkboard-teacher"></i></div>
                            <h4 class="font-bold text-gray-900 mb-1">Guru Kompeten</h4>
                            <p class="text-sm text-gray-600">Tenaga pendidik profesional</p>
                        </div>
                        <div class="gradient-card p-5 rounded-xl hover-lift">
                            <div class="text-3xl mb-2 text-purple-600"><i class="fas fa-trophy"></i></div>
                            <h4 class="font-bold text-gray-900 mb-1">Prestasi Gemilang</h4>
                            <p class="text-sm text-gray-600">Juara berbagai kompetisi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Sekolah -->
    <section id="program" class="py-20 gradient-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-full mb-6 text-sm font-semibold">
                    <i class="fas fa-star mr-2"></i>
                    Keunggulan Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih SD IT Baitul Ihsan?
                </h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Kami memberikan pendidikan berkualitas dengan pendekatan holistik yang mengintegrasikan aspek
                    spiritual, intelektual, dan sosial.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Keunggulan 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-quran"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Program Hafalan Qur'an</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Target hafalan minimal 2 juz selama 6 tahun dengan metode tahfidz yang menyenangkan dan efektif.
                    </p>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pembelajaran Active Learning</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Metode belajar interaktif dengan pendekatan student-centered menggunakan teknologi edukatif.
                    </p>
                </div>

                <!-- Keunggulan 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Guru Profesional</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Tenaga pendidik berkualifikasi S1/S2, bersertifikat, dan berpengalaman.
                    </p>
                </div>

                <!-- Keunggulan 4 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Fasilitas Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Gedung modern ber-AC, lab komputer, perpustakaan digital, dan area olahraga representatif.
                    </p>
                </div>

                <!-- Keunggulan 5 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ekstrakurikuler Islami</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Beragam pilihan ekskul: Tahfidz, Kaligrafi, Hadroh, Panahan, Futsal, dan Robotik.
                    </p>
                </div>

                <!-- Keunggulan 6 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-t-4 border-purple-500">
                    <div
                        class="w-16 h-16 gradient-bg rounded-2xl flex items-center justify-center text-white text-3xl mb-6">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pendidikan Karakter</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Pembentukan akhlak mulia melalui pembiasaan ibadah harian dan adab islami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur PPDB -->
    <section id="informasi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-full mb-6 text-sm font-semibold">
                    <i class="fas fa-list-check mr-2"></i>
                    Alur Pendaftaran
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Proses Pendaftaran PPDB
                </h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Ikuti 4 langkah mudah untuk menjadi bagian dari keluarga besar SD IT Baitul Ihsan
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                <!-- Step 1 -->
                <div class="text-center step-line">
                    <div class="relative inline-block mb-6">
                        <div
                            class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-2xl mx-auto">
                            1
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pengisian Formulir Online</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Isi formulir pendaftaran secara online melalui website resmi kami.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center step-line">
                    <div class="relative inline-block mb-6">
                        <div
                            class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-2xl mx-auto">
                            2
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Upload Berkas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Upload scan dokumen persyaratan: KK, Akta Kelahiran, dan Foto.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center step-line">
                    <div class="relative inline-block mb-6">
                        <div
                            class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-2xl mx-auto">
                            3
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Wawancara Orang Tua</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ikuti sesi wawancara dengan kepala sekolah untuk mengenal visi misi sekolah.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div class="relative inline-block mb-6">
                        <div
                            class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-2xl mx-auto">
                            4
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pengumuman Hasil</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pengumuman hasil seleksi melalui website dan WhatsApp.
                    </p>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('daftar.sekarang') }}"
                    class="inline-flex items-center gradient-bg text-white px-10 py-4 rounded-full font-bold text-lg hover:opacity-90 transition shadow-2xl hover:shadow-3xl">
                    <i class="fas fa-play-circle mr-2"></i>Mulai Pendaftaran
                </a>
            </div>
        </div>
    </section>

    <!-- Syarat Pendaftaran & Biaya -->
    <section class="py-20 gradient-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-start">
                <!-- Syarat -->
                <div>
                    <div
                        class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-full mb-6 text-sm font-semibold">
                        <i class="fas fa-file-alt mr-2"></i>
                        Persyaratan
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Syarat Pendaftaran PPDB
                    </h2>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Siapkan dokumen-dokumen berikut untuk proses pendaftaran:
                    </p>

                    <div class="space-y-4">
                        <div class="bg-white rounded-2xl p-6 shadow-lg flex items-start space-x-4 hover-lift">
                            <div
                                class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1 text-lg">Pas Foto Berwarna 3x4</h4>
                                <p class="text-gray-600">Background merah, 2 lembar dalam format JPG</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg flex items-start space-x-4 hover-lift">
                            <div
                                class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1 text-lg">Scan KTP Orang Tua</h4>
                                <p class="text-gray-600">KTP Ayah dan Ibu format PDF atau JPG</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg flex items-start space-x-4 hover-lift">
                            <div
                                class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center flex-shrink-0 text-white text-xl">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1 text-lg">Akte Kelahiran</h4>
                                <p class="text-gray-600">Scan/foto akte kelahiran asli</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 hover-lift">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Biaya Pendaftaran</h3>
                    <div class="space-y-6 mb-8">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600 font-medium">Formulir Pendaftaran</span>
                            <span class="text-2xl font-bold text-purple-600">Rp 300.000</span>
                        </div>
                        <div class="gradient-card rounded-2xl p-6">
                            <div class="flex items-center">
                                <i class="fas fa-gift text-2xl text-purple-600 mr-3"></i>
                                <div>
                                    <p class="text-sm font-semibold text-purple-800 mb-2">🎉 Promo Early Bird!</p>
                                    <p class="text-gray-700 font-bold text-xl mb-2">Potongan Rp 100.000</p>
                                    <p class="text-gray-600 text-sm">Untuk pendaftar sebelum 31 Desember 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                        * Biaya pendaftaran sudah termasuk tes psikologi, observasi, dan wawancara orang tua.
                        Biaya pendaftaran tidak dapat dikembalikan.
                    </p>
                    <a href="{{ route('daftar.sekarang') }}"
                        class="block w-full gradient-bg text-white px-8 py-4 rounded-full font-bold text-center hover:opacity-90 transition shadow-xl hover:shadow-2xl">
                        <i class="fas fa-arrow-right mr-2"></i>Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center gradient-bg text-white px-4 py-2 rounded-full mb-6 text-sm font-semibold">
                    <i class="fas fa-comments mr-2"></i>
                    Testimoni
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Kata Mereka tentang Kami
                </h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Kepercayaan orang tua adalah kebanggaan kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-2 border-gray-100">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mr-4 text-white text-2xl">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Budi Santoso</h4>
                            <p class="text-gray-500 text-sm">Orang Tua Siswa Kelas 3</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 text-2xl mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Alhamdulillah, anak saya sangat senang belajar di SD IT Baitul Ihsan. Guru-gurunya sangat
                        perhatian dan metode mengajarnya menyenangkan."
                    </p>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-2 border-gray-100">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mr-4 text-white text-2xl">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Siti Nurhaliza</h4>
                            <p class="text-gray-500 text-sm">Orang Tua Siswa Kelas 5</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 text-2xl mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Sekolah yang luar biasa! Fasilitas lengkap, lingkungan islami, dan yang paling penting akhlak
                        anak saya terbentuk dengan baik."
                    </p>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl hover-lift border-2 border-gray-100">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mr-4 text-white text-2xl">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg">Ahmad Fauzi</h4>
                            <p class="text-gray-500 text-sm">Orang Tua Siswa Kelas 2</p>
                        </div>
                    </div>
                    <div class="text-yellow-400 text-2xl mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed italic">
                        "Pilihan terbaik untuk pendidikan anak. Selain akademik yang bagus, pembinaan karakternya juga
                        sangat baik. Anak saya jadi lebih mandiri."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-20 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-80 h-80 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Siap Bergabung dengan Kami?
            </h2>
            <p class="text-white/90 text-xl mb-10 max-w-3xl mx-auto leading-relaxed">
                Jangan lewatkan kesempatan emas untuk memberikan pendidikan terbaik bagi putra-putri Anda.
                Kuota terbatas, daftar sekarang!
            </p>

            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 mb-10 inline-block">
                <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                    <div class="text-center">
                        <div class="text-yellow-300 text-5xl mb-3"><i class="fas fa-phone-alt"></i></div>
                        <p class="text-white/80 text-sm mb-1">Hotline PPDB</p>
                        <p class="text-white font-bold text-2xl">0812-3456-7890</p>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-white/30"></div>
                    <div class="text-center">
                        <div class="text-yellow-300 text-5xl mb-3"><i class="fab fa-whatsapp"></i></div>
                        <p class="text-white/80 text-sm mb-1">WhatsApp</p>
                        <p class="text-white font-bold text-2xl">0812-3456-7891</p>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-white/30"></div>
                    <div class="text-center">
                        <div class="text-yellow-300 text-5xl mb-3"><i class="fas fa-envelope"></i></div>
                        <p class="text-white/80 text-sm mb-1">Email</p>
                        <p class="text-white font-bold text-xl">ppdb@sditbaitulihsan.sch.id</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('daftar.sekarang') }}"
                    class="bg-white text-purple-700 px-10 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition-all duration-300 shadow-2xl hover:shadow-3xl">
                    <i class="fas fa-graduation-cap mr-2"></i>Daftar Online Sekarang
                </a>
                <a href="https://wa.me/6281234567891"
                    class="bg-white/20 backdrop-blur-sm text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white/30 transition-all duration-300 border-2 border-white">
                    <i class="fab fa-whatsapp mr-2"></i>Konsultasi via WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="gradient-bg text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-10 mb-12">
                <!-- Tentang -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-purple-600 font-bold text-xl">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">SD IT Baitul Ihsan</h3>
                            <p class="text-sm text-white/80">Sekolah Islam Terpadu</p>
                        </div>
                    </div>
                    <p class="text-white/90 leading-relaxed mb-6">
                        Mendidik generasi Qurani dengan pendekatan islami modern.
                        Membentuk karakter unggul, berakhlak mulia, dan berprestasi.
                    </p>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 italic border-l-4 border-yellow-300">
                        <p class="text-sm text-white/90">
                            "Dan sungguh akan Kami berikan cobaan kepadamu, dengan sedikit ketakutan, kelaparan,
                            kekurangan harta, jiwa dan buah-buahan. Dan berikanlah berita gembira kepada orang-orang
                            yang sabar."
                        </p>
                        <p class="text-xs mt-2 text-yellow-300 font-semibold">- QS. Al-Baqarah: 155</p>
                    </div>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="text-xl font-bold mb-6">Kontak Kami</h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="text-yellow-300 text-xl mt-1"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <p class="text-sm text-white/80">Alamat</p>
                                <p class="font-medium">Jl. Pendidikan No. 123, Pekalongan, Jawa Tengah 51111</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="text-yellow-300 text-xl mt-1"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <p class="text-sm text-white/80">Telepon</p>
                                <p class="font-medium">0812-3456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="text-yellow-300 text-xl mt-1"><i class="fas fa-envelope"></i></div>
                            <div>
                                <p class="text-sm text-white/80">Email</p>
                                <p class="font-medium">info@sditbaitulihsan.sch.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="text-xl font-bold mb-6">Ikuti Kami</h4>
                    <div class="flex space-x-4 mb-6">
                        <a href="#"
                            class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>

                    <!-- Jam Pelayanan -->
                    <div class="bg-white/10 rounded-lg p-4">
                        <h5 class="font-bold mb-2">Jam Pelayanan</h5>
                        <p class="text-sm">Senin - Jumat: 07.00 - 16.00 WIB</p>
                        <p class="text-sm">Sabtu: 07.00 - 12.00 WIB</p>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/20 pt-8 text-center">
                <p class="text-white/80 text-sm">
                    © 2024 SD IT Baitul Ihsan. All Rights Reserved. | Made with ❤️ for Better Education
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Navbar Background on Scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg', 'bg-white');
            } else {
                nav.classList.remove('shadow-lg');
                nav.classList.add('bg-white/90');
            }
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>

</body>

</html>
