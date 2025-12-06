<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - PPDB SD IT Baitul Ihsan</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .shadow-2xl {
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">

    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

                <!-- Header -->
                <div class="bg-gradient-to-r from-green-500 to-blue-500 py-10 px-8 text-center">
                    <div class="inline-block bg-white/20 p-4 rounded-full mb-6">
                        <i class="fas fa-check-circle text-white text-5xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Pendaftaran Berhasil!</h1>
                    <p class="text-white/90 text-lg">Data pendaftaran Anda telah berhasil dikirim dan sedang menunggu
                        verifikasi admin.</p>
                </div>

                <!-- Content -->
                <div class="p-8 md:p-10">

                    <!-- Nomor Pendaftaran -->
                    <div class="text-center mb-10">
                        <p class="text-gray-600 mb-2">Nomor Pendaftaran Anda:</p>
                        <div class="inline-block bg-gradient-to-r from-purple-100 to-pink-100 border-2 border-dashed border-purple-300 px-8 py-4 rounded-2xl cursor-pointer"
                            onclick="copyRegistrationNumber()" title="Klik untuk menyalin">
                            <p class="text-3xl font-bold text-purple-700 tracking-wider" id="noPendaftaran">
                                {{ $ppdb->no_pendaftaran ?? 'N/A' }}
                            </p>
                        </div>
                        <p class="text-gray-500 text-sm mt-3">
                            <i class="fas fa-info-circle mr-1"></i>Klik nomor untuk menyalin
                        </p>
                    </div>

                    <!-- Status & Timeline -->
                    <div class="grid md:grid-cols-2 gap-8 mb-10">

                        <!-- Status -->
                        <div
                            class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-hourglass-half text-yellow-500 mr-3"></i>
                                Status Pendaftaran
                            </h3>
                            <div>
                                <p class="text-2xl font-bold text-yellow-600">
                                    {{ $ppdb->status_label ?? 'Menunggu Verifikasi' }}
                                </p>
                                <p class="text-gray-600 text-sm mt-2">Menunggu verifikasi oleh admin sekolah</p>
                                <div
                                    class="mt-4 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold inline-block">
                                    {{ $ppdb->status == 'diterima' ? 'Terverifikasi' : 'Dalam Proses' }}
                                </div>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                                Timeline Proses
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 text-sm">Pendaftaran Online</span>
                                    <span class="ml-auto text-green-600 text-xs font-semibold">Selesai</span>
                                </li>
                                <li class="flex items-center">
                                    <div
                                        class="w-8 h-8 {{ $ppdb->status == 'diterima' ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full flex items-center justify-center mr-3">
                                        <i
                                            class="fas {{ $ppdb->status == 'diterima' ? 'fa-check' : 'fa-clock' }} text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 text-sm">Verifikasi Admin</span>
                                    <span
                                        class="ml-auto text-xs {{ $ppdb->status == 'diterima' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $ppdb->status == 'diterima' ? 'Selesai' : '1-3 hari kerja' }}
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 text-sm">Wawancara</span>
                                    <span class="ml-auto text-gray-500 text-xs">Menunggu</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700 text-sm">Pengumuman</span>
                                    <span class="ml-auto text-gray-500 text-xs">Menunggu</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Informasi Calon Siswa -->
                    <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user-graduate text-purple-500 mr-3"></i>
                            Informasi Calon Siswa
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->nama ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">NIK</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->nik ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tempat, Tanggal Lahir</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $ppdb->tempat_lahir ?? 'N/A' }}, {{ $ppdb->tanggal_lahir_formatted ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Jenis Kelamin</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->jenis_kelamin ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Asal Sekolah</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->asal_sekolah ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Nama Orang Tua</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->nama_ayah ?? 'N/A' }} &
                                    {{ $ppdb->nama_ibu ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center space-y-4 no-print">

                        <!-- WhatsApp Button -->
                        <a href="{{ $whatsappUrl ?? '#' }}" target="_blank"
                            class="inline-flex items-center justify-center w-full md:w-auto bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg hover:shadow-xl">
                            <i class="fab fa-whatsapp mr-3 text-2xl"></i>
                            Konfirmasi via WhatsApp
                        </a>

                        <!-- Info Kontak -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 mt-6">
                            <h4 class="font-bold text-gray-800 mb-3">Butuh Bantuan?</h4>
                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <i class="fas fa-phone-alt text-purple-500 text-xl mb-2"></i>
                                    <p class="text-xs text-gray-600">Hotline PPDB</p>
                                    <p class="font-bold text-gray-800">0822-2583-2575</p>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-envelope text-purple-500 text-xl mb-2"></i>
                                    <p class="text-xs text-gray-600">Email</p>
                                    <p class="font-bold text-gray-800 text-sm">ppdb@sditbaitulihsan.sch.id</p>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-clock text-purple-500 text-xl mb-2"></i>
                                    <p class="text-xs text-gray-600">Jam Operasional</p>
                                    <p class="font-bold text-gray-800">07.00 - 16.00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <a href="{{ route('home') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-xl font-semibold text-center transition">
                                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                            </a>
                            <button onclick="window.print()"
                                class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-800 px-6 py-3 rounded-xl font-semibold transition">
                                <i class="fas fa-print mr-2"></i>Cetak Bukti
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center text-gray-600 text-sm no-print">
                <p>© {{ date('Y') }} SD IT Baitul Ihsan. Semua hak dilindungi.</p>
                <p class="mt-1">Proses verifikasi maksimal 3 hari kerja.</p>
            </div>
        </div>
    </div>

    <script>
        // Copy nomor pendaftaran
        function copyRegistrationNumber() {
            const text = document.getElementById('noPendaftaran').textContent.trim();

            if (!text || text === 'N/A') {
                showNotification('Nomor pendaftaran tidak tersedia!', 'error');
                return;
            }

            // Fallback untuk browser lama
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    showNotification('Nomor pendaftaran berhasil disalin!', 'success');
                }).catch(err => {
                    console.error('Gagal menyalin: ', err);
                    copyToClipboardFallback(text);
                });
            } else {
                copyToClipboardFallback(text);
            }
        }

        // Fallback copy method
        function copyToClipboardFallback(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();

            try {
                document.execCommand('copy');
                showNotification('Nomor pendaftaran berhasil disalin!', 'success');
            } catch (err) {
                showNotification('Gagal menyalin nomor', 'error');
            }

            document.body.removeChild(textarea);
        }

        // Show notification
        function showNotification(message, type = 'info') {
            const colors = {
                'success': 'bg-green-500',
                'error': 'bg-red-500',
                'info': 'bg-blue-500'
            };

            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle mr-2"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Print handlers
        window.onbeforeprint = function() {
            document.body.classList.add('printing');
        };

        window.onafterprint = function() {
            document.body.classList.remove('printing');
        };
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>

</body>

</html>
