{{-- ppdb/success.blade.php --}}
@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - PPDB SD IT Baitul Ihsan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
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
                            <p class="text-3xl font-bold text-purple-700 tracking-wider">
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
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-hourglass-half text-yellow-500 mr-3"></i>
                                Status Pendaftaran
                            </h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-2xl font-bold text-yellow-600">
                                        {{ $ppdb->status_label ?? 'Menunggu Verifikasi' }}
                                    </p>
                                    <p class="text-gray-600 text-sm mt-2">Menunggu verifikasi oleh admin sekolah</p>
                                </div>
                                <div class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                                    {{ $ppdb->status == 'verified' ? 'Terverifikasi' : 'Proses' }}
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
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700">Pendaftaran Online</span>
                                    <span class="ml-auto text-green-600 text-sm font-semibold">Selesai</span>
                                </li>
                                <li class="flex items-center">
                                    <div
                                        class="w-8 h-8 {{ $ppdb->status == 'verified' ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full flex items-center justify-center mr-3">
                                        <i
                                            class="fas {{ $ppdb->status == 'verified' ? 'fa-check' : 'fa-clock' }} text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700">Verifikasi Admin</span>
                                    <span
                                        class="ml-auto text-sm {{ $ppdb->status == 'verified' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ $ppdb->status == 'verified' ? 'Selesai' : '1-3 hari kerja' }}
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700">Wawancara Orang Tua</span>
                                    <span class="ml-auto text-gray-500 text-sm">Menunggu</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    </div>
                                    <span class="text-gray-700">Pengumuman Hasil</span>
                                    <span class="ml-auto text-gray-500 text-sm">Menunggu</span>
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
                                <p class="text-sm text-gray-500 mb-1">Asal Sekolah</p>
                                <p class="font-semibold text-gray-800">{{ $ppdb->asal_sekolah ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="text-center space-y-4">
                        <!-- Konfirmasi ke WhatsApp Admin -->
                        <a href="{{ $whatsappUrl ?? '#' }}" target="_blank"
                            class="inline-flex items-center justify-center w-full md:w-auto bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg hover:shadow-xl">
                            <i class="fab fa-whatsapp mr-3 text-xl"></i>
                            Konfirmasi Pendaftaran via WhatsApp
                        </a>

                        <!-- Info Kontak -->
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 mt-6">
                            <h4 class="font-bold text-gray-800 mb-3">Butuh Bantuan?</h4>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex items-center">
                                    <i class="fas fa-phone-alt text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Hotline PPDB</p>
                                        <p class="font-bold text-gray-800">0822-2583-2575</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Email</p>
                                        <p class="font-bold text-gray-800">ppdb@sditbaitulihsan.sch.id</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Jam Operasional</p>
                                        <p class="font-bold text-gray-800">07.00 - 16.00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <a href="{{ route('home') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-xl font-semibold text-center transition">
                                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
                            </a>
                            <button onclick="window.print()"
                                class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-800 px-6 py-3 rounded-xl font-semibold transition">
                                <i class="fas fa-print mr-2"></i>Cetak Bukti Pendaftaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="mt-8 text-center text-gray-600 text-sm">
                <p>© {{ date('Y') }} SD IT Baitul Ihsan. Semua hak dilindungi.</p>
                <p class="mt-1">Proses pendaftaran akan diverifikasi maksimal dalam 3 hari kerja.</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Auto copy nomor pendaftaran ke clipboard
        function copyRegistrationNumber() {
            const text = "{{ $ppdb->no_pendaftaran ?? '' }}";
            if (!text) {
                alert('Nomor pendaftaran tidak tersedia!');
                return;
            }

            navigator.clipboard.writeText(text).then(() => {
                // Sweet alert atau toast notification lebih baik
                showNotification('Nomor pendaftaran berhasil disalin!', 'success');
            }).catch(err => {
                console.error('Gagal menyalin: ', err);
                showNotification('Gagal menyalin nomor', 'error');
            });
        }

        function showNotification(message, type = 'info') {
            // Buat notifikasi sederhana
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Print styling
        window.onbeforeprint = function() {
            document.body.classList.add('printing');
        };

        window.onafterprint = function() {
            document.body.classList.remove('printing');
        };
    </script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .bg-gradient-to-br {
                background: white !important;
            }

            .shadow-2xl {
                box-shadow: none !important;
            }

            .rounded-3xl {
                border-radius: 0 !important;
            }

            button,
            a {
                display: none !important;
            }
        }
    </style>
@endsection
