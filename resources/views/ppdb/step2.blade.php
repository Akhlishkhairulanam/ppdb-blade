@extends('layouts.app')

@section('title', 'PPDB - Step 2: Data Orang Tua')

@section('content')
    <div class="glass-card w-full p-10 text-white">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2">👨‍👩‍👧 Step 2 — Data Orang Tua</h2>
            <p class="text-white/80">Isi data orang tua/wali calon siswa</p>
        </div>

        <!-- Form -->
        <form action="{{ route('daftar.step2.submit') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Data Ayah -->
                <div class="space-y-5">
                    <h3 class="text-xl font-bold text-white mb-4 border-b border-white/30 pb-2">Data Ayah</h3>

                    <div>
                        <label class="block text-white/80 mb-2">Nama Ayah</label>
                        <input type="text" name="nama_ayah" placeholder="Nama lengkap ayah" class="input-modern" required
                            value="{{ old('nama_ayah') }}">
                        @error('nama_ayah')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Nomor HP Ayah</label>
                        <input type="text" name="no_hp_ayah" placeholder="Contoh: 081234567890" class="input-modern"
                            required value="{{ old('no_hp_ayah') }}">
                        @error('no_hp_ayah')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Data Ibu -->
                <div class="space-y-5">
                    <h3 class="text-xl font-bold text-white mb-4 border-b border-white/30 pb-2">Data Ibu</h3>

                    <div>
                        <label class="block text-white/80 mb-2">Nama Ibu</label>
                        <input type="text" name="nama_ibu" placeholder="Nama lengkap ibu" class="input-modern" required
                            value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Nomor HP Ibu</label>
                        <input type="text" name="no_hp_ibu" placeholder="Contoh: 081234567891" class="input-modern"
                            required value="{{ old('no_hp_ibu') }}">
                        @error('no_hp_ibu')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Data Umum -->
                <div class="md:col-span-2 space-y-5">
                    <div>
                        <label class="block text-white/80 mb-2">Pendapatan Orang Tua</label>
                        <select name="pendapatan" class="input-modern" required>
                            <option value="" disabled selected>Pilih Pendapatan</option>
                            <option value="<1 juta" {{ old('pendapatan') == '<1 juta' ? 'selected' : '' }}>Kurang dari 1
                                juta</option>
                            <option value="1-3 juta" {{ old('pendapatan') == '1-3 juta' ? 'selected' : '' }}>1 - 3 juta
                            </option>
                            <option value="3-5 juta" {{ old('pendapatan') == '3-5 juta' ? 'selected' : '' }}>3 - 5 juta
                            </option>
                            <option value=">5 juta" {{ old('pendapatan') == '>5 juta' ? 'selected' : '' }}>Lebih dari 5
                                juta</option>
                        </select>
                        @error('pendapatan')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-white/80 mb-2">Alamat Tinggal Saat Ini</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat tempat tinggal saat ini" class="input-modern" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="text-red-300 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between mt-10 pt-6 border-t border-white/20">
                <a href="{{ route('daftar.sekarang') }}" class="btn-modern bg-gray-600 hover:bg-gray-700 text-center">
                    ← Kembali ke Step 1
                </a>
                <button type="submit" class="btn-modern">
                    Lanjut ke Step 3 →
                </button>
            </div>
        </form>

        <!-- Progress Indicator -->
        <div class="flex justify-center mt-8">
            <div class="flex items-center space-x-4">
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">1</div>
                <div class="w-20 h-1 bg-white"></div>
                <div class="w-8 h-8 rounded-full bg-white text-purple-600 flex items-center justify-center font-bold">2
                </div>
                <div class="w-20 h-1 bg-white/30"></div>
                <div class="w-8 h-8 rounded-full bg-white/30 text-white flex items-center justify-center font-bold">3</div>
            </div>
        </div>
    </div>
@endsection
