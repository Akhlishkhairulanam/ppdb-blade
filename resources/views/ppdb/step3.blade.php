@extends('layouts.app')

@section('title', 'PPDB - Step 3: Upload Berkas')

@section('content')
    <div class="glass-card w-full p-10 text-white">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">📎 Step 3 — Upload Berkas</h2>
            <p class="text-white/80">Upload dokumen persyaratan pendaftaran</p>
        </div>

        <!-- Preview Data -->
        <div class="bg-white/10 rounded-xl p-6 mb-8">
            <h3 class="text-xl font-bold mb-4 border-b border-white/30 pb-2">Data Pendaftaran</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-bold text-yellow-300 mb-2">Data Siswa</h4>
                    <p class="text-sm">Nama: <span class="font-medium">{{ session('step1.nama') }}</span></p>
                    <p class="text-sm">NIK: <span class="font-medium">{{ session('step1.nik') }}</span></p>
                    <p class="text-sm">TTL: <span class="font-medium">{{ session('step1.tempat_lahir') }},
                            {{ date('d-m-Y', strtotime(session('step1.tanggal_lahir'))) }}</span></p>
                </div>

                <div>
                    <h4 class="font-bold text-yellow-300 mb-2">Data Orang Tua</h4>
                    <p class="text-sm">Ayah: <span class="font-medium">{{ session('step2.nama_ayah') }}</span></p>
                    <p class="text-sm">Ibu: <span class="font-medium">{{ session('step2.nama_ibu') }}</span></p>
                    <p class="text-sm">HP Ayah: <span class="font-medium">{{ session('step2.no_hp_ayah') }}</span></p>
                </div>
            </div>
        </div>
        @if (session('warning'))
            <div class="bg-yellow-500/20 text-yellow-200 p-4 rounded-lg mb-6">
                ⚠️ {{ session('warning') }}
            </div>
        @endif
        <!-- Form Upload -->
        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" id="submitForm">
            @csrf

            <div class="space-y-6">
                <!-- Foto Anak -->
                <div>
                    <label class="block text-white/80 mb-2">
                        <span class="font-bold">1. Pas Foto Anak (3x4)</span>
                        <span class="text-red-300">*</span>
                    </label>
                    <input type="file" name="foto_anak"
                        class="input-modern file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-purple-600 hover:file:bg-white/90"
                        accept=".jpg,.jpeg,.png" required>
                    <p class="text-white/60 text-sm mt-1">Format: JPG/PNG, ukuran maksimal 2MB</p>
                    @error('foto_anak')
                        <span class="text-red-300 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto KK -->
                <div>
                    <label class="block text-white/80 mb-2">
                        <span class="font-bold">2. Foto Kartu Keluarga (KK)</span>
                        <span class="text-red-300">*</span>
                    </label>
                    <input type="file" name="foto_kk"
                        class="input-modern file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-purple-600 hover:file:bg-white/90"
                        accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="text-white/60 text-sm mt-1">Format: JPG/PNG/PDF, ukuran maksimal 2MB</p>
                    @error('foto_kk')
                        <span class="text-red-300 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto KTP Ayah -->
                <div>
                    <label class="block text-white/80 mb-2">
                        <span class="font-bold">3. Foto KTP Ayah</span>
                        <span class="text-red-300">*</span>
                    </label>
                    <input type="file" name="foto_ktp_ayah"
                        class="input-modern file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-purple-600 hover:file:bg-white/90"
                        accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="text-white/60 text-sm mt-1">Format: JPG/PNG/PDF, ukuran maksimal 2MB</p>
                    @error('foto_ktp_ayah')
                        <span class="text-red-300 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto KTP Ibu -->
                <div>
                    <label class="block text-white/80 mb-2">
                        <span class="font-bold">4. Foto KTP Ibu</span>
                        <span class="text-red-300">*</span>
                    </label>
                    <input type="file" name="foto_ktp_ibu"
                        class="input-modern file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-purple-600 hover:file:bg-white/90"
                        accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="text-white/60 text-sm mt-1">Format: JPG/PNG/PDF, ukuran maksimal 2MB</p>
                    @error('foto_ktp_ibu')
                        <span class="text-red-300 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-10 pt-6 border-t border-white/20">
                <a href="{{ route('daftar.step2') }}" class="btn-modern bg-gray-600 hover:bg-gray-700 text-center">
                    ← Kembali ke Step 2
                </a>
                <button type="submit" class="btn-modern flex items-center justify-center gap-3">
                    <span id="submitText">Kirim Pendaftaran</span>
                    <div id="loader"
                        class="hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                </button>
            </div>
        </form>

        <!-- Progress Indicator -->
        <div class="flex justify-center mt-8">
            <div class="flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">1</div>
                <div class="w-20 h-1 bg-white/30"></div>
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">2</div>
                <div class="w-20 h-1 bg-white"></div>
                <div class="w-8 h-8 rounded-full bg-white text-purple-600 flex items-center justify-center font-bold">3
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("submitForm").addEventListener("submit", function() {
            this.querySelector("button[type=submit]").disabled = true;
            document.getElementById("submitText").classList.add("hidden");
            document.getElementById("loader").classList.remove("hidden");
        });
    </script>

@endsection
