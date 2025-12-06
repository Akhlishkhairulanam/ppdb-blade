@extends('layouts.app')

@section('title', 'PPDB - Step 1: Data Siswa')

@section('content')
    <div class="glass-card w-full p-10 text-white">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">🧒 Step 1 — Data Siswa</h2>
            <p class="text-white/80">Isi data calon siswa dengan lengkap dan benar</p>
        </div>

        <!-- Form -->
        <form action="{{ route('daftar.step1.submit') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Kolom 1 -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-white/80 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Nama lengkap siswa" class="input-modern" required
                            value="{{ old('nama') }}">
                        @error('nama')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">NIK (16 Digit)</label>
                        <input type="text" name="nik" placeholder="16 digit NIK" class="input-modern" required
                            value="{{ old('nik') }}">
                        @error('nik')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Kota/Kabupaten" class="input-modern" required
                            value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="input-modern" required
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-white/80 mb-2">Email</label>
                        <input type="email" name="email" placeholder="email@example.com" class="input-modern" required
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-white/80 mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="input-modern" required>
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Anak Ke</label>
                        <input type="text" name="anak_ke" placeholder="Contoh: 1, 2, 3" class="input-modern" required
                            value="{{ old('anak_ke') }}">
                        @error('anak_ke')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Dari Berapa Bersaudara</label>
                        <input type="text" name="dari_bersaudara" placeholder="Contoh: 3 bersaudara" class="input-modern"
                            required value="{{ old('dari_bersaudara') }}">
                        @error('dari_bersaudara')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="1" placeholder="Alamat lengkap sesuai KK" class="input-modern" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Di dalam form, setelah alamat -->


                    <div class="md:col-span-2">
                        <label class="block text-white/80 mb-2">Asal Sekolah (TK/RA)</label>
                        <input type="text" name="asal_sekolah" placeholder="Nama TK/RA sebelumnya" class="input-modern"
                            required value="{{ old('asal_sekolah') }}">
                        @error('asal_sekolah')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-10 pt-6 border-t border-white/20">
                <a href="{{ route('home') }}" class="btn-modern bg-gray-600 hover:bg-gray-700 text-center">
                    ← Kembali ke Beranda
                </a>
                <button type="submit" class="btn-modern">
                    Lanjut ke Step 2 →
                </button>
            </div>
        </form>

        <!-- Progress Indicator -->
        <div class="flex justify-center mt-8">
            <div class="flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-white text-purple-600 flex items-center justify-center font-bold">1
                </div>
                <div class="w-20 h-1 bg-white/30"></div>
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">2</div>
                <div class="w-20 h-1 bg-white/30"></div>
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">3</div>
            </div>
        </div>
    </div>
@endsection
