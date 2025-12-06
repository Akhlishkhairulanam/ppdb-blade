<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppdb;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PpdbController extends Controller
{
    /**
     * Menampilkan form multi-step (utama)
     */
    public function step1()
    {
        // Clear session lama
        session()->forget(['step1', 'step2', 'step3']);

        return view('daftar-sekarang', [
            'csrf_token' => csrf_token(),
            'timestamp' => now()->timestamp
        ]);
    }

    /**
     * Menampilkan form step 1 (terpisah)
     */
    public function step1View()
    {
        return view('ppdb.step1');
    }

    /**
     * Submit form step 1 dengan AJAX (untuk sistem terpisah)
     */
    public function step1Submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:ppdbs,nik',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|integer|min:1|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'anak_ke' => 'required|integer|min:1',
            'dari_bersaudara' => 'required|integer|min:1',
            'asal_sekolah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:ppdbs,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data step 1 ke session
        session(['step1' => $request->all()]);

        return response()->json([
            'success' => true,
            'message' => 'Data step 1 berhasil disimpan',
            'redirect' => route('daftar.step2')
        ]);
    }

    /**
     * Menampilkan form step 2 (terpisah)
     */
    public function step2View()
    {
        if (!session()->has('step1')) {
            return redirect()->route('daftar.step1')->with('error', 'Silakan isi data siswa terlebih dahulu');
        }

        $step1 = session('step1');
        return view('ppdb.step2', compact('step1'));
    }

    /**
     * Submit form step 2 dengan AJAX (untuk sistem terpisah)
     */
    public function step2Submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp_ayah' => 'required|string|max:15',
            'no_hp_ibu' => 'required|string|max:15',
            'pendapatan' => 'required|string|max:50',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data step 2 ke session
        session(['step2' => $request->all()]);

        return response()->json([
            'success' => true,
            'message' => 'Data step 2 berhasil disimpan',
            'redirect' => route('daftar.step3')
        ]);
    }

    /**
     * Menampilkan form step 3 (terpisah)
     */
    public function step3View()
    {
        if (!session()->has('step1') || !session()->has('step2')) {
            return redirect()->route('daftar.step1')->with('error', 'Silakan isi data sebelumnya terlebih dahulu');
        }

        $step1 = session('step1');
        $step2 = session('step2');

        return view('ppdb.step3', compact('step1', 'step2'));
    }

    /**
     * Store data pendaftaran - DARI SEMUA SISTEM
     */
    public function store(Request $request)
    {
        Log::info('🚀 =========== PPDB STORE METHOD START ===========');
        Log::info('📅 Timestamp: ' . now()->toDateTimeString());
        Log::info('🌐 IP Address: ' . $request->ip());
        Log::info('🖥️ User Agent: ' . $request->header('User-Agent'));
        Log::info('🔐 CSRF Token: ' . $request->_token);

        // Log semua input kecuali file
        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            if (!is_array($value) && !is_object($value)) {
                Log::info("📝 Input [$key]: " . $value);
            }
        }

        // Log file uploads
        $fileFields = ['foto_anak', 'foto_kk', 'foto_akte', 'foto_ktp_ayah', 'foto_ktp_ibu'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                Log::info("📎 File [$field]: " . $file->getClientOriginalName() . " (" . $file->getSize() . " bytes)");
            } else {
                Log::info("❌ File [$field]: NOT UPLOADED");
            }
        }

        try {
            // Tentukan source form
            $isMultiStep = $request->has('nama') && $request->has('nama_ayah'); // Form multi-step
            $isSeparateStep = session()->has('step1') && session()->has('step2'); // Form terpisah

            Log::info("🔍 Form type: " . ($isMultiStep ? 'Multi-step' : ($isSeparateStep ? 'Separate steps' : 'Unknown')));

            if ($isSeparateStep) {
                // Ambil data dari session (untuk sistem terpisah)
                $step1 = session('step1');
                $step2 = session('step2');

                Log::info("📦 Data from session - Step1 keys: " . implode(', ', array_keys($step1 ?? [])));
                Log::info("📦 Data from session - Step2 keys: " . implode(', ', array_keys($step2 ?? [])));

                // Merge data dari session dan file uploads
                $mergedData = array_merge($step1 ?? [], $step2 ?? []);

                // Tambahkan file uploads dari request
                foreach ($fileFields as $field) {
                    if ($request->hasFile($field)) {
                        $mergedData[$field] = $request->file($field);
                    }
                }

                // Gunakan merged data untuk validasi
                $validationData = $mergedData;
            } else {
                // Gunakan data langsung dari request (untuk multi-step)
                $validationData = $request->all();
            }

            Log::info("📊 Total data fields for validation: " . count($validationData));

            // Validasi dengan pesan error yang jelas
            $validator = Validator::make($validationData, [
                // Data Calon Siswa
                'nama' => 'required|string|max:255',
                'nik' => 'required|digits:16|unique:ppdbs,nik',
                'tempat_lahir' => 'required|string|max:100',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|integer|min:1|max:20',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'anak_ke' => 'required|integer|min:1',
                'dari_bersaudara' => 'required|integer|min:1',
                'asal_sekolah' => 'required|string|max:255',
                'alamat' => 'required|string',

                // Data Orang Tua
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'no_hp_ayah' => 'required|string|max:15',
                'no_hp_ibu' => 'required|string|max:15',
                'pendapatan' => 'required|string|max:50',
                'alamat_orang_tua' => 'required|string',

                // File uploads
                'foto_anak' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'foto_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_akte' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_ktp_ayah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'foto_ktp_ibu' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'nik.digits' => 'NIK harus 16 digit angka',
                'nik.unique' => 'NIK ini sudah terdaftar',
                'foto_anak.required' => 'Pas foto anak wajib diupload',
                'foto_anak.mimes' => 'Pas foto harus format JPG, JPEG, atau PNG',
                'foto_anak.max' => 'Pas foto maksimal 2MB',
                'foto_kk.required' => 'Foto KK wajib diupload',
                'foto_kk.mimes' => 'Foto KK harus format JPG, JPEG, PNG, atau PDF',
                'no_hp_ayah.max' => 'Nomor HP ayah maksimal 15 digit',
                'no_hp_ibu.max' => 'Nomor HP ibu maksimal 15 digit',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Log::error('❌ Validation errors: ' . implode(', ', $errors));

                // Untuk AJAX request (sistem terpisah)
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Validasi gagal'
                    ], 422);
                }

                // Untuk regular request (multi-step)
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terdapat kesalahan dalam pengisian data. Silakan periksa kembali.');
            }

            $validated = $validator->validated();
            Log::info('✅ Validation passed! Fields: ' . implode(', ', array_keys($validated)));

            // Cek duplikat NIK sebelum upload file
            $existing = Ppdb::where('nik', $validated['nik'])->first();
            if ($existing) {
                Log::warning('⚠️ Duplicate NIK: ' . $validated['nik']);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'NIK ini sudah terdaftar. Silakan gunakan NIK lain atau hubungi admin.');
            }

            // Generate nomor pendaftaran yang lebih baik
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $random = strtoupper(Str::random(4));
            $noPendaftaran = "PPDB-{$year}{$month}{$day}-{$random}";
            Log::info('🎫 Generated No Pendaftaran: ' . $noPendaftaran);

            // Siapkan data untuk disimpan
            $dataToSave = [
                'no_pendaftaran' => $noPendaftaran,
                'nama' => $validated['nama'],
                'nik' => $validated['nik'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'umur' => $validated['umur'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'anak_ke' => $validated['anak_ke'],
                'dari_bersaudara' => $validated['dari_bersaudara'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'alamat' => $validated['alamat'],
                'nama_ayah' => $validated['nama_ayah'],
                'nama_ibu' => $validated['nama_ibu'],
                'no_hp_ayah' => $validated['no_hp_ayah'],
                'no_hp_ibu' => $validated['no_hp_ibu'],
                'pendapatan' => $validated['pendapatan'],
                'alamat_orang_tua' => $validated['alamat_orang_tua'],
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tambahkan email jika ada (dari sistem terpisah)
            if (isset($validated['email'])) {
                $dataToSave['email'] = $validated['email'];
            }

            // Upload file ke storage
            $uploadPath = 'dokumen/ppdb/' . date('Y/m/d');

            // Pastikan folder ada
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath, 0755, true);
                Log::info('📁 Created directory: ' . $uploadPath);
            }

            $uploadedFiles = [];
            foreach ($fileFields as $field) {
                if (isset($validated[$field]) && $validated[$field] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $validated[$field];
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    // Generate unique filename
                    $filename = Str::slug($validated['nama']) . '_' . $field . '_' . time() . '.' . $extension;
                    $path = $file->storeAs($uploadPath, $filename, 'public');

                    $dataToSave[$field] = $path;
                    $uploadedFiles[$field] = $path;
                    Log::info("✅ File uploaded - {$field}: {$path} (original: {$originalName})");
                } else {
                    Log::error("❌ File {$field} is missing or invalid!");
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "File {$field} tidak valid. Silakan upload ulang.");
                }
            }

            Log::info('💾 Attempting to save to database...');
            Log::info('📋 Data to save keys: ' . implode(', ', array_keys($dataToSave)));

            // Simpan ke database
            $ppdb = Ppdb::create($dataToSave);

            Log::info('🎉 DATA SAVED SUCCESSFULLY!');
            Log::info('🆔 ID: ' . $ppdb->id);
            Log::info('📇 No Pendaftaran: ' . $ppdb->no_pendaftaran);
            Log::info('👤 Nama: ' . $ppdb->nama);
            Log::info('📞 HP Ayah: ' . $ppdb->no_hp_ayah);

            // Clear session data jika dari sistem terpisah
            if ($isSeparateStep) {
                session()->forget(['step1', 'step2']);
                Log::info('🧹 Session cleared');
            }

            // Redirect ke halaman sukses
            $successUrl = route('daftar.success', ['id' => $ppdb->id]);
            Log::info('🔗 Redirecting to: ' . $successUrl);

            return redirect($successUrl)
                ->with([
                    'success' => 'Pendaftaran berhasil!',
                    'no_pendaftaran' => $ppdb->no_pendaftaran,
                    'nama' => $ppdb->nama,
                    'flash_timestamp' => now()->timestamp
                ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation Exception: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()));
        } catch (\Exception $e) {
            Log::error('💥 CRITICAL ERROR in store method:');
            Log::error('📝 Message: ' . $e->getMessage());
            Log::error('🗂️ File: ' . $e->getFile());
            Log::error('📍 Line: ' . $e->getLine());
            Log::error('🔍 Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage() . '. Silakan coba lagi atau hubungi admin di 0822-2583-2575.');
        }
    }

    /**
     * Tampilkan halaman sukses
     */
    public function showSuccess($id)
    {
        try {
            Log::info('🔄 Accessing success page for ID: ' . $id);

            $ppdb = Ppdb::find($id);

            if (!$ppdb) {
                Log::warning('⚠️ PPDB not found for ID: ' . $id);

                // Coba cari berdasarkan flash data
                if (session('no_pendaftaran')) {
                    Log::info('🔍 Searching by No Pendaftaran: ' . session('no_pendaftaran'));
                    $ppdb = Ppdb::where('no_pendaftaran', session('no_pendaftaran'))->first();
                }

                if (!$ppdb) {
                    Log::error('❌ Data not found. Redirecting to form.');
                    return redirect()->route('daftar.sekarang')
                        ->with('error', 'Data pendaftaran tidak ditemukan. Silakan daftar ulang.');
                }
            }

            Log::info('✅ Found PPDB: ' . $ppdb->no_pendaftaran . ' - ' . $ppdb->nama);

            // Format data
            $ppdb->tanggal_lahir_formatted = Carbon::parse($ppdb->tanggal_lahir)->translatedFormat('d F Y');

            // Status label
            $statusLabels = [
                'menunggu' => 'Menunggu Verifikasi',
                'diterima' => 'Diterima',
                'ditolak' => 'Ditolak',
                'verified' => 'Terverifikasi'
            ];
            $ppdb->status_label = $statusLabels[$ppdb->status] ?? $ppdb->status;

            // WhatsApp URL
            $whatsappMessage = "Halo Admin PPDB SD IT Baitul Ihsan,\n\n"
                . "Saya *{$ppdb->nama_ayah}* (ayah dari *{$ppdb->nama}*) ingin mengonfirmasi pendaftaran PPDB dengan detail:\n\n"
                . "📋 *DATA PENDAFTARAN*\n"
                . "• No. Pendaftaran: *{$ppdb->no_pendaftaran}*\n"
                . "• Nama Calon Siswa: *{$ppdb->nama}*\n"
                . "• NIK: *{$ppdb->nik}*\n"
                . "• TTL: *{$ppdb->tempat_lahir}, {$ppdb->tanggal_lahir_formatted}*\n"
                . "• Asal Sekolah: *{$ppdb->asal_sekolah}*\n"
                . "• Nama Ayah: *{$ppdb->nama_ayah}*\n"
                . "• No HP Ayah: *{$ppdb->no_hp_ayah}*\n\n"
                . "Mohon konfirmasi bahwa data ini telah diterima.\n\n"
                . "Terima kasih.";

            $whatsappUrl = "https://wa.me/6282225832575?text=" . urlencode($whatsappMessage);

            return view('ppdb.success', [
                'ppdb' => $ppdb,
                'whatsappUrl' => $whatsappUrl
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Error in success page: ' . $e->getMessage());

            // Fallback view sederhana
            return view('ppdb.success-fallback', [
                'no_pendaftaran' => session('no_pendaftaran', 'Tidak diketahui'),
                'nama' => session('nama', 'Tidak diketahui'),
                'error' => 'Data tidak dapat ditampilkan sepenuhnya. Silakan hubungi admin di 0822-2583-2575.'
            ]);
        }
    }

    // ... (method lainnya tetap sama seperti sebelumnya)

    /**
     * Halaman admin untuk melihat data pendaftar
     */
    public function admin()
    {
        $data = Ppdb::orderBy('created_at', 'desc')->get();
        $pendingCount = Ppdb::where('status', 'menunggu')->count();
        $acceptedCount = Ppdb::where('status', 'diterima')->count();
        $rejectedCount = Ppdb::where('status', 'ditolak')->count();

        return view('admin.pendaftar', compact('data', 'pendingCount', 'acceptedCount', 'rejectedCount'));
    }

    /**
     * Update status pendaftaran (dari admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $ppdb = Ppdb::findOrFail($id);

        if ($request->status == 'diterima' || $request->status == 'ditolak') {
            $ppdb->disetujui_pada = now();
            $ppdb->disetujui_oleh = 'Admin';
        }

        $ppdb->status = $request->status;
        $ppdb->catatan_admin = $request->catatan_admin;
        $ppdb->save();

        if ($request->status == 'diterima') {
            $message = "🎉 *SELAMAT! PENDAFTARAN DITERIMA*\n\n"
                . "Kepada Yth. Bapak/Ibu {$ppdb->nama_ayah},\n\n"
                . "Kami dengan senang hati menginformasikan bahwa pendaftaran PPDB untuk:\n"
                . "Nama: *{$ppdb->nama}*\n"
                . "No. Pendaftaran: {$ppdb->no_pendaftaran}\n\n"
                . "*TELAH DITERIMA* di SD IT Baitul Ihsan.\n\n"
                . "📅 *Tahap Selanjutnya:*\n"
                . "1. Daftar ulang di sekolah\n"
                . "2. Pembayaran biaya sekolah\n"
                . "3. Orientasi siswa baru\n\n"
                . "📞 Hubungi kami untuk info lebih lanjut:\n"
                . "0822-2583-2575";

            $waUrl = "https://wa.me/62" . substr($ppdb->no_hp_ayah, 1) . "?text=" . urlencode($message);

            return redirect()->back()
                ->with('success', 'Status berhasil diubah. <a href="' . $waUrl . '" target="_blank" class="underline">Kirim notifikasi ke WhatsApp</a>');
        } elseif ($request->status == 'ditolak') {
            $message = "Mohon maaf, pendaftaran PPDB untuk {$ppdb->nama} dengan No. Pendaftaran {$ppdb->no_pendaftaran} tidak dapat kami terima. Terima kasih atas minat Anda.";

            $waUrl = "https://wa.me/62" . substr($ppdb->no_hp_ayah, 1) . "?text=" . urlencode($message);

            return redirect()->back()
                ->with('info', 'Status berhasil diubah. <a href="' . $waUrl . '" target="_blank" class="underline">Kirim notifikasi ke WhatsApp</a>');
        }

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    /**
     * Hapus data pendaftaran
     */
    public function destroy($id)
    {
        $ppdb = Ppdb::findOrFail($id);

        Storage::disk('public')->delete([
            $ppdb->foto_anak ?? '',
            $ppdb->foto_kk ?? '',
            $ppdb->foto_akte ?? '',
            $ppdb->foto_ktp_ayah ?? '',
            $ppdb->foto_ktp_ibu ?? ''
        ]);

        $ppdb->delete();

        return redirect()->route('ppdb.admin')->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Detail data pendaftaran
     */
    public function show($id)
    {
        $ppdb = Ppdb::findOrFail($id);
        return view('admin.detail', compact('ppdb'));
    }
}
