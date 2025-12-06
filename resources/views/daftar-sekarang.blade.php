<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PPDB - Daftar Sekarang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            outline: none;
            background: white;
            transition: all 0.3s;
        }

        .input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #7c3aed, #db2777);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Formulir PPDB 2025/2026</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Isi data dengan lengkap dan benar untuk melanjutkan proses
                    pendaftaran</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-12">
                <div class="relative">
                    <div class="absolute top-5 left-0 right-0 h-2 bg-gray-200 rounded-full mx-8 md:mx-16"></div>
                    <div id="activeProgressBar"
                        class="absolute top-5 left-0 h-2 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full transition-all duration-500 ease-in-out mx-8 md:mx-16"
                        style="width: 0%"></div>

                    <div class="flex justify-between relative z-10">
                        @foreach (['Data Siswa', 'Data Orang Tua', 'Dokumen', 'Konfirmasi'] as $index => $step)
                            <div class="flex flex-col items-center w-1/4">
                                <div id="stepCircle{{ $index + 1 }}"
                                    class="w-12 h-12 rounded-full flex items-center justify-center border-4 border-white shadow-lg transition-all duration-300 {{ $index == 0 ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white' : 'bg-gray-100 text-gray-400' }}">
                                    <span class="font-bold text-lg">{{ $index + 1 }}</span>
                                </div>
                                <div class="mt-3 text-center">
                                    <div class="text-xs font-semibold text-gray-700">{{ $step }}</div>
                                    <div class="text-xs text-gray-500 mt-1">Step {{ $index + 1 }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" id="ppdbForm">
                    @csrf

                    <!-- Step 1: Data Calon Siswa -->
                    <div id="step1" class="p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-4 border-b">Data Calon Siswa</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" required class="input"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    NIK (16 Digit) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nik" required class="input" placeholder="16 digit NIK"
                                    maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tempat Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="tempat_lahir" required class="input"
                                    placeholder="Kota/Kabupaten" value="{{ old('tempat_lahir') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" required class="input"
                                    onchange="calculateAge()" value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Umur (tahun) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="umur" id="umur" required class="input"
                                    placeholder="Otomatis" readonly value="{{ old('umur') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis_kelamin" required class="input">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Anak Ke <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="anak_ke" required class="input"
                                    placeholder="Contoh: 1, 2, 3" min="1" value="{{ old('anak_ke') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Dari Berapa Bersaudara <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="dari_bersaudara" required class="input"
                                    placeholder="Contoh: 3" min="1" value="{{ old('dari_bersaudara') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Asal Sekolah (TK/RA) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="asal_sekolah" required class="input"
                                    placeholder="Nama TK/RA sebelumnya" value="{{ old('asal_sekolah') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat" rows="3" required class="input" placeholder="Alamat lengkap tempat tinggal">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-10 pt-6 border-t">
                            <button type="button" onclick="nextStep()" class="btn-primary px-8">
                                Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Data Orang Tua -->
                    <div id="step2" class="p-8" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-4 border-b">Data Orang Tua</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ayah" required class="input"
                                    placeholder="Nama lengkap ayah" value="{{ old('nama_ayah') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama_ibu" required class="input"
                                    placeholder="Nama lengkap ibu" value="{{ old('nama_ibu') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor HP Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="no_hp_ayah" required class="input"
                                    placeholder="08xxxxxxxxxx" value="{{ old('no_hp_ayah') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor HP Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="no_hp_ibu" required class="input"
                                    placeholder="08xxxxxxxxxx" value="{{ old('no_hp_ibu') }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Penghasilan Bulanan (Rupiah) <span class="text-red-500">*</span>
                                </label>
                                <select name="pendapatan" required class="input">
                                    <option value="">Pilih Penghasilan</option>
                                    <option value="< 1 juta" {{ old('pendapatan') == '< 1 juta' ? 'selected' : '' }}>
                                        Kurang dari 1 juta</option>
                                    <option value="1 - 3 juta"
                                        {{ old('pendapatan') == '1 - 3 juta' ? 'selected' : '' }}>1 - 3 juta</option>
                                    <option value="3 - 5 juta"
                                        {{ old('pendapatan') == '3 - 5 juta' ? 'selected' : '' }}>3 - 5 juta</option>
                                    <option value="5 - 10 juta"
                                        {{ old('pendapatan') == '5 - 10 juta' ? 'selected' : '' }}>5 - 10 juta</option>
                                    <option value="> 10 juta"
                                        {{ old('pendapatan') == '> 10 juta' ? 'selected' : '' }}>Lebih dari 10 juta
                                    </option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Lengkap Orang Tua <span class="text-red-500">*</span>
                                </label>
                                <textarea name="alamat_orang_tua" rows="3" required class="input" placeholder="Alamat lengkap orang tua">{{ old('alamat_orang_tua') }}</textarea>
                            </div>
                        </div>
                        <div class="flex justify-between mt-10 pt-6 border-t">
                            <button type="button" onclick="prevStep()" class="btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="button" onclick="nextStep()" class="btn-primary px-8">
                                Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Dokumen Pendukung -->
                    <div id="step3" class="p-8" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-4 border-b">Dokumen Pendukung</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Pas Foto 3x4 <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="foto_anak" required accept=".jpg,.jpeg,.png"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewFile(this, 'fotoPreview')">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG atau PNG, latar belakang merah (maks.
                                    2MB)</p>
                                <div id="fotoPreviewContainer" class="mt-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Pratinjau:</p>
                                    <img id="fotoPreview" class="w-32 h-40 object-cover rounded-lg border shadow">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Kartu Keluarga (KK) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="foto_kk" required accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewFile(this, 'kkPreview')">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (maks. 2MB)</p>
                                <div id="kkPreviewContainer" class="mt-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Pratinjau:</p>
                                    <img id="kkPreview" class="w-48 h-32 object-cover rounded-lg border shadow">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Akte Kelahiran <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="foto_akte" required accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewFile(this, 'aktePreview')">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (maks. 2MB)</p>
                                <div id="aktePreviewContainer" class="mt-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Pratinjau:</p>
                                    <img id="aktePreview" class="w-48 h-32 object-cover rounded-lg border shadow">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto KTP Ayah <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="foto_ktp_ayah" required accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewFile(this, 'ktpAyahPreview')">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (maks. 2MB)</p>
                                <div id="ktpAyahPreviewContainer" class="mt-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Pratinjau:</p>
                                    <img id="ktpAyahPreview" class="w-48 h-32 object-cover rounded-lg border shadow">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Foto KTP Ibu <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="foto_ktp_ibu" required accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewFile(this, 'ktpIbuPreview')">
                                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, atau PDF (maks. 2MB)</p>
                                <div id="ktpIbuPreviewContainer" class="mt-4" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">Pratinjau:</p>
                                    <img id="ktpIbuPreview" class="w-48 h-32 object-cover rounded-lg border shadow">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-10 pt-6 border-t">
                            <button type="button" onclick="prevStep()" class="btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="button" onclick="validateStep3()" class="btn-primary px-8">
                                Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Konfirmasi -->
                    <div id="step4" class="p-8" style="display: none;">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-4 border-b">Konfirmasi Data</h2>
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 mb-8">
                            <div class="flex items-center text-indigo-600 mb-4">
                                <i class="fas fa-check-circle text-xl mr-2"></i>
                                <h3 class="font-semibold">Pastikan data berikut sudah benar</h3>
                            </div>
                            <p class="text-gray-600">Periksa kembali data yang telah Anda isi. Data tidak dapat diubah
                                setelah dikirim.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-700 mb-3">Data Calon Siswa</h4>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Nama:</span> <span id="summaryNama"></span></p>
                                    <p><span class="font-medium">NIK:</span> <span id="summaryNik"></span></p>
                                    <p><span class="font-medium">TTL:</span> <span id="summaryTtl"></span></p>
                                    <p><span class="font-medium">Umur:</span> <span id="summaryUmur"></span> tahun</p>
                                    <p><span class="font-medium">Jenis Kelamin:</span> <span
                                            id="summaryJenisKelamin"></span></p>
                                    <p><span class="font-medium">Anak Ke:</span> <span id="summaryAnakKe"></span></p>
                                    <p><span class="font-medium">Dari Bersaudara:</span> <span
                                            id="summaryBersaudara"></span></p>
                                    <p><span class="font-medium">Asal Sekolah:</span> <span
                                            id="summarySekolah"></span></p>
                                    <p><span class="font-medium">Alamat:</span> <span id="summaryAlamat"></span></p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-3">Data Orang Tua</h4>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-medium">Nama Ayah:</span> <span id="summaryAyah"></span>
                                        </p>
                                        <p><span class="font-medium">Nama Ibu:</span> <span id="summaryIbu"></span>
                                        </p>
                                        <p><span class="font-medium">HP Ayah:</span> <span id="summaryHpAyah"></span>
                                        </p>
                                        <p><span class="font-medium">HP Ibu:</span> <span id="summaryHpIbu"></span>
                                        </p>
                                        <p><span class="font-medium">Penghasilan:</span> <span
                                                id="summaryPenghasilan"></span></p>
                                        <p><span class="font-medium">Alamat Orang Tua:</span> <span
                                                id="summaryAlamatOrtu"></span></p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-3">Dokumen</h4>
                                    <div class="space-y-3" id="docSummary"></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-10 pt-6 border-t">
                            <button type="button" onclick="prevStep()" class="btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </button>
                            <button type="submit" class="btn-primary px-10" id="submitBtn">
                                <span id="submitText">Kirim Pendaftaran</span>
                                <span id="submitLoading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="text-center mt-8 text-gray-500 text-sm">
                <p>Butuh bantuan? Hubungi kami di <a href="mailto:ppdb@sdit.example.com"
                        class="text-indigo-600 hover:underline">ppdb@sdit.example.com</a></p>
                <p class="mt-1">© 2025 SDIT. Semua hak dilindungi.</p>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function showStep(stepNumber) {
            for (let i = 1; i <= 4; i++) {
                const step = document.getElementById('step' + i);
                if (step) step.style.display = 'none';
            }
            const activeStep = document.getElementById('step' + stepNumber);
            if (activeStep) activeStep.style.display = 'block';

            updateProgress(stepNumber);

            if (stepNumber === 4) {
                updateSummary();
            }

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function updateProgress(stepNumber) {
            const progressPercentage = ((stepNumber - 1) / 3) * 100;
            const activeProgressBar = document.getElementById('activeProgressBar');
            if (activeProgressBar) {
                activeProgressBar.style.width = `${progressPercentage}%`;
            }

            for (let i = 1; i <= 4; i++) {
                const circle = document.getElementById('stepCircle' + i);
                if (circle) {
                    if (i < stepNumber) {
                        circle.className =
                            'w-12 h-12 rounded-full flex items-center justify-center border-4 border-white shadow-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white';
                        circle.innerHTML = '<i class="fas fa-check text-sm"></i>';
                    } else if (i === stepNumber) {
                        circle.className =
                            'w-12 h-12 rounded-full flex items-center justify-center border-4 border-white shadow-lg bg-gradient-to-r from-indigo-600 to-purple-600 text-white';
                        circle.innerHTML = `<span class="font-bold text-lg">${i}</span>`;
                    } else {
                        circle.className =
                            'w-12 h-12 rounded-full flex items-center justify-center border-4 border-white shadow-lg bg-gray-100 text-gray-400';
                        circle.innerHTML = `<span class="font-bold text-lg">${i}</span>`;
                    }
                }
            }
        }

        function nextStep() {
            if (validateStep(currentStep)) {
                if (currentStep < 4) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        // Validasi lebih detail
        function validateStep(step) {
            let isValid = true;

            if (step === 1) {
                // Validasi semua field step 1 yang ada di HTML
                const fields = [{
                        selector: 'input[name="nama"]',
                        message: 'Nama lengkap wajib diisi'
                    },
                    {
                        selector: 'input[name="nik"]',
                        message: 'NIK wajib diisi',
                        regex: /^\d{16}$/,
                        regexMessage: 'NIK harus 16 digit angka'
                    },
                    {
                        selector: 'input[name="tempat_lahir"]',
                        message: 'Tempat lahir wajib diisi'
                    },
                    {
                        selector: 'input[name="tanggal_lahir"]',
                        message: 'Tanggal lahir wajib diisi'
                    },
                    {
                        selector: 'input[name="umur"]',
                        message: 'Umur wajib diisi'
                    },
                    {
                        selector: 'select[name="jenis_kelamin"]',
                        message: 'Jenis kelamin wajib dipilih'
                    },
                    {
                        selector: 'input[name="anak_ke"]',
                        message: 'Anak ke wajib diisi'
                    },
                    {
                        selector: 'input[name="dari_bersaudara"]',
                        message: 'Dari berapa bersaudara wajib diisi'
                    },
                    {
                        selector: 'input[name="asal_sekolah"]',
                        message: 'Asal sekolah wajib diisi'
                    },
                    {
                        selector: 'textarea[name="alamat"]',
                        message: 'Alamat wajib diisi'
                    }
                ];

                fields.forEach(field => {
                    const element = document.querySelector(field.selector);
                    if (element) {
                        const value = element.value.trim();

                        // Cek jika kosong
                        if (!value) {
                            showFieldError(element, field.message);
                            isValid = false;
                        }
                        // Cek regex jika ada
                        else if (field.regex && !field.regex.test(value)) {
                            showFieldError(element, field.regexMessage || field.message);
                            isValid = false;
                        }
                    }
                });

                if (!isValid) {
                    showAlert('error', 'Harap lengkapi semua data calon siswa');
                }

                return isValid;
            }

            if (step === 2) {
                // Validasi semua field step 2 yang ada di HTML
                const fields = [{
                        selector: 'input[name="nama_ayah"]',
                        message: 'Nama ayah wajib diisi'
                    },
                    {
                        selector: 'input[name="nama_ibu"]',
                        message: 'Nama ibu wajib diisi'
                    },
                    {
                        selector: 'input[name="no_hp_ayah"]',
                        message: 'Nomor HP ayah wajib diisi',
                        regex: /^[0-9]{10,13}$/,
                        regexMessage: 'Format nomor HP tidak valid'
                    },
                    {
                        selector: 'input[name="no_hp_ibu"]',
                        message: 'Nomor HP ibu wajib diisi',
                        regex: /^[0-9]{10,13}$/,
                        regexMessage: 'Format nomor HP tidak valid'
                    },
                    {
                        selector: 'select[name="pendapatan"]',
                        message: 'Penghasilan wajib dipilih'
                    },
                    {
                        selector: 'textarea[name="alamat_orang_tua"]',
                        message: 'Alamat orang tua wajib diisi'
                    }
                ];

                fields.forEach(field => {
                    const element = document.querySelector(field.selector);
                    if (element) {
                        const value = field.selector.includes('no_hp') ?
                            element.value.trim().replace(/[^0-9]/g, '') :
                            element.value.trim();

                        if (!value) {
                            showFieldError(element, field.message);
                            isValid = false;
                        } else if (field.regex && !field.regex.test(value)) {
                            showFieldError(element, field.regexMessage || field.message);
                            isValid = false;
                        }
                    }
                });

                if (!isValid) {
                    showAlert('error', 'Harap lengkapi semua data orang tua');
                }

                return isValid;
            }

            return true;
        }

        function validateStep3() {
            const inputs = document.querySelectorAll('#step3 input[type="file"]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.files.length) {
                    input.classList.add('border-red-500');
                    isValid = false;
                } else {
                    const file = input.files[0];

                    // Validasi ukuran file (2MB = 2 * 1024 * 1024 bytes)
                    if (file.size > 2 * 1024 * 1024) {
                        showFieldError(input, 'Ukuran file maksimal 2MB');
                        input.value = '';
                        isValid = false;
                    }

                    // Validasi tipe file
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    if (!validTypes.includes(file.type)) {
                        showFieldError(input, 'Format harus JPG, PNG, atau PDF');
                        input.value = '';
                        isValid = false;
                    }

                    if (isValid) {
                        input.classList.remove('border-red-500');
                    }
                }
            });

            if (isValid) {
                nextStep();
            } else {
                showAlert('error', 'Harap unggah semua dokumen dengan format yang benar');
            }
        }

        function calculateAge() {
            const birthDate = document.querySelector('input[name="tanggal_lahir"]').value;
            if (!birthDate) return;

            try {
                const today = new Date();
                const birth = new Date(birthDate);

                // Validasi tanggal lahir tidak di masa depan
                if (birth > today) {
                    showAlert('error', 'Tanggal lahir tidak boleh melebihi hari ini');
                    document.querySelector('input[name="tanggal_lahir"]').value = '';
                    document.getElementById('umur').value = '';
                    return;
                }

                let age = today.getFullYear() - birth.getFullYear();
                const monthDiff = today.getMonth() - birth.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                    age--;
                }

                document.getElementById('umur').value = age;
            } catch (error) {
                console.error('Error calculating age:', error);
            }
        }

        function previewFile(input, previewId) {
            const file = input.files[0];
            if (!file) return;

            // Reset error state
            input.classList.remove('border-red-500');

            // Validasi ukuran file
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                showFieldError(input, 'Ukuran file maksimal 2MB');
                input.value = '';
                return;
            }

            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!validTypes.includes(file.type)) {
                showFieldError(input, 'Format harus JPG, PNG, atau PDF');
                input.value = '';
                return;
            }

            // Preview untuk gambar
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    const container = document.getElementById(previewId + 'Container');
                    if (preview && container) {
                        preview.src = e.target.result;
                        container.style.display = 'block';
                    }
                };
                reader.onerror = function() {
                    showAlert('error', 'Gagal membaca file');
                    input.value = '';
                };
                reader.readAsDataURL(file);
            } else {
                // Untuk PDF, tampilkan icon PDF
                const container = document.getElementById(previewId + 'Container');
                if (container) {
                    container.style.display = 'block';
                    const preview = document.getElementById(previewId);
                    if (preview) {
                        preview.src = 'https://cdn-icons-png.flaticon.com/512/337/337946.png';
                    }
                }
            }
        }

        function updateSummary() {
            try {
                // Ambil data dari form step 1
                const getValue = (selector) => document.querySelector(selector)?.value.trim() || '-';

                const nama = getValue('input[name="nama"]');
                const nik = getValue('input[name="nik"]');
                const tempatLahir = getValue('input[name="tempat_lahir"]');
                const tanggalLahir = getValue('input[name="tanggal_lahir"]');
                const umur = document.getElementById('umur')?.value || '-';
                const jenisKelamin = getValue('select[name="jenis_kelamin"]');
                const anakKe = getValue('input[name="anak_ke"]');
                const dariBersaudara = getValue('input[name="dari_bersaudara"]');

                const asalSekolah = getValue('input[name="asal_sekolah"]');
                const alamat = getValue('textarea[name="alamat"]');

                // Ambil data dari form step 2
                const namaAyah = getValue('input[name="nama_ayah"]');
                const namaIbu = getValue('input[name="nama_ibu"]');
                const noHpAyah = formatPhoneNumber(getValue('input[name="no_hp_ayah"]'));
                const noHpIbu = formatPhoneNumber(getValue('input[name="no_hp_ibu"]'));
                const pendapatan = getValue('select[name="pendapatan"]');
                const alamatOrtu = getValue('textarea[name="alamat_orang_tua"]');

                // Format tanggal
                let tanggalFormatted = '-';
                if (tanggalLahir && tanggalLahir !== '-') {
                    try {
                        const tanggal = new Date(tanggalLahir);
                        const options = {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        };
                        tanggalFormatted = tanggal.toLocaleDateString('id-ID', options);
                    } catch (e) {
                        tanggalFormatted = tanggalLahir;
                    }
                }

                // Update summary data siswa
                const updateElement = (id, value) => {
                    const el = document.getElementById(id);
                    if (el) el.textContent = value;
                };

                updateElement('summaryNama', nama);
                updateElement('summaryNik', nik);
                updateElement('summaryTtl', `${tempatLahir}, ${tanggalFormatted}`);
                updateElement('summaryUmur', umur);
                updateElement('summaryJenisKelamin', jenisKelamin);
                updateElement('summaryAnakKe', anakKe);
                updateElement('summaryBersaudara', dariBersaudara);

                updateElement('summarySekolah', asalSekolah);
                updateElement('summaryAlamat', alamat);

                // Update summary data orang tua
                updateElement('summaryAyah', namaAyah);
                updateElement('summaryIbu', namaIbu);
                updateElement('summaryHpAyah', noHpAyah);
                updateElement('summaryHpIbu', noHpIbu);
                updateElement('summaryPenghasilan', pendapatan);
                updateElement('summaryAlamatOrtu', alamatOrtu);

                // Update dokumen summary
                updateDocumentSummary();

            } catch (error) {
                console.error('Error updating summary:', error);
                showAlert('error', 'Gagal memperbarui ringkasan data');
            }
        }

        function updateDocumentSummary() {
            const docSummary = document.getElementById('docSummary');
            if (!docSummary) return;

            docSummary.innerHTML = '';

            const files = [{
                    name: 'Kartu Keluarga',
                    id: 'foto_kk',
                    icon: 'fa-file-contract'
                },
                {
                    name: 'Akte Kelahiran',
                    id: 'foto_akte',
                    icon: 'fa-certificate'
                },
                {
                    name: 'Pas Foto',
                    id: 'foto_anak',
                    icon: 'fa-camera'
                },
                {
                    name: 'KTP Ayah',
                    id: 'foto_ktp_ayah',
                    icon: 'fa-id-card'
                },
                {
                    name: 'KTP Ibu',
                    id: 'foto_ktp_ibu',
                    icon: 'fa-id-card'
                }
            ];

            files.forEach(file => {
                const input = document.querySelector(`input[name="${file.id}"]`);
                const div = document.createElement('div');
                div.className = 'flex items-center mb-2';

                if (input && input.files.length > 0) {
                    div.innerHTML = `
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-700">${file.name}</div>
                        <div class="text-xs text-gray-500">${formatFileSize(input.files[0].size)} • ${input.files[0].name}</div>
                    </div>
                `;
                } else {
                    div.innerHTML = `
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-times text-red-600"></i>
                    </div>
                    <div class="text-sm font-medium text-gray-500">${file.name} (belum diunggah)</div>
                `;
                }

                docSummary.appendChild(div);
            });
        }

        // Helper functions
        function formatPhoneNumber(phone) {
            if (!phone || phone === '-') return '-';
            // Format: 0812-3456-7890
            const cleaned = phone.replace(/\D/g, '');
            if (cleaned.length >= 10) {
                return cleaned.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1-$2-$3');
            }
            return phone;
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function showFieldError(selector, message) {
            const element = typeof selector === 'string' ?
                document.querySelector(selector) :
                selector;

            if (element) {
                element.classList.add('border-red-500', 'border-2');

                // Hapus error sebelumnya
                const existingError = element.nextElementSibling;
                if (existingError && existingError.classList.contains('field-error')) {
                    existingError.remove();
                }

                // Tambah pesan error
                const errorDiv = document.createElement('div');
                errorDiv.className = 'field-error text-red-500 text-xs mt-1';
                errorDiv.textContent = message;
                element.parentNode.appendChild(errorDiv);

                // Fokus ke field yang error
                element.focus();
            }
        }

        function showAlert(type, message) {
            // Hapus alert sebelumnya
            const existingAlert = document.getElementById('formAlert');
            if (existingAlert) existingAlert.remove();

            // Buat alert baru
            const alertDiv = document.createElement('div');
            alertDiv.id = 'formAlert';
            alertDiv.className =
                `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-transform transform translate-x-full animate-slide-in`;

            if (type === 'error') {
                alertDiv.className += ' bg-red-50 border-l-4 border-red-500 text-red-700';
            } else {
                alertDiv.className += ' bg-green-50 border-l-4 border-green-500 text-green-700';
            }

            alertDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'} mr-3"></i>
                <div>${message}</div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

            document.body.appendChild(alertDiv);

            // Auto remove setelah 5 detik
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.classList.add('animate-slide-out');
                    setTimeout(() => {
                        if (alertDiv.parentNode) alertDiv.remove();
                    }, 300);
                }
            }, 5000);
        }

        function submitForm(e) {
            e.preventDefault(); // Mencegah submit langsung

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitLoading = document.getElementById('submitLoading');

            // Validasi step 4
            if (currentStep === 4) {
                if (confirm('Apakah Anda yakin data yang diisi sudah benar? Data tidak dapat diubah setelah dikirim.')) {
                    // Tampilkan loading
                    if (submitText) submitText.style.display = 'none';
                    if (submitLoading) submitLoading.style.display = 'inline';
                    if (submitBtn) submitBtn.disabled = true;

                    // Disable semua input untuk mencegah submit ulang
                    const inputs = document.querySelectorAll('input, select, textarea, button');
                    inputs.forEach(input => {
                        input.disabled = true;
                    });

                    // Tampilkan pesan "Sedang mengirim..."
                    showAlert('info', 'Sedang mengirim data pendaftaran...');

                    // Submit form dengan AJAX untuk debugging
                    const formData = new FormData(document.getElementById('ppdbForm'));

                    fetch("{{ route('daftar.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (response.redirected) {
                                // Redirect ke halaman sukses
                                window.location.href = response.url;
                            } else {
                                return response.json();
                            }
                        })
                        .then(data => {
                            if (data && data.success === false) {
                                showAlert('error', 'Gagal mengirim data: ' + (data.message || 'Terjadi kesalahan'));
                                // Enable kembali form
                                inputs.forEach(input => input.disabled = false);
                                if (submitText) submitText.style.display = 'inline';
                                if (submitLoading) submitLoading.style.display = 'none';
                                if (submitBtn) submitBtn.disabled = false;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showAlert('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
                            // Enable kembali form
                            inputs.forEach(input => input.disabled = false);
                            if (submitText) submitText.style.display = 'inline';
                            if (submitLoading) submitLoading.style.display = 'none';
                            if (submitBtn) submitBtn.disabled = false;
                        });

                    return false;
                }
                return false;
            }
            return false;
        }
        // Validasi real-time
        document.addEventListener('input', function(e) {
            const target = e.target;

            // Hapus error state saat user mulai mengetik
            if (target.classList.contains('border-red-500')) {
                target.classList.remove('border-red-500', 'border-2');
                const errorMsg = target.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains('field-error')) {
                    errorMsg.remove();
                }
            }
        });

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
            console.log('Form PPDB siap digunakan!');

            // Hitung umur otomatis jika tanggal lahir sudah ada
            calculateAge();

            // Event listener untuk perubahan tanggal lahir
            const tanggalLahirInput = document.querySelector('input[name="tanggal_lahir"]');
            if (tanggalLahirInput) {
                tanggalLahirInput.addEventListener('change', calculateAge);
            }

            // Tambah CSS untuk animasi
            const style = document.createElement('style');
            style.textContent = `
            .animate-slide-in {
                animation: slideIn 0.3s forwards;
            }
            .animate-slide-out {
                animation: slideOut 0.3s forwards;
            }
            @keyframes slideIn {
                from { transform: translateX(100%); }
                to { transform: translateX(0); }
            }
            @keyframes slideOut {
                from { transform: translateX(0); }
                to { transform: translateX(100%); }
            }
            .field-error {
                animation: fadeIn 0.3s;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-5px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>
