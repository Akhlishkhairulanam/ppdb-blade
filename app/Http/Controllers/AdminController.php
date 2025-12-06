<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = Ppdb::count();
        $pending = Ppdb::where('status', 'menunggu')->count();
        $accepted = Ppdb::where('status', 'diterima')->count();
        $rejected = Ppdb::where('status', 'ditolak')->count();
        $recentRegistrations = Ppdb::latest()->take(5)->get();

        return view('admin.dashboard', compact('total', 'pending', 'accepted', 'rejected', 'recentRegistrations'));
    }

    public function index(Request $request)
    {
        $query = Ppdb::query();

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_pendaftaran', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nama_ayah', 'like', "%{$search}%");
            });
        }

        $registrations = $query->latest()->paginate(20);

        return view('admin.registrations.index', compact('registrations'));
    }

    public function show($id)
    {
        $registration = Ppdb::findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }

    public function approve($id)
    {
        $registration = Ppdb::findOrFail($id);

        // Gunakan Auth facade untuk menghindari warning Intelephense
        if (Auth::check()) {
            $adminName = Auth::user()->name;
        } else {
            $adminName = 'System';
        }

        $registration->update([
            'status' => 'diterima',
            'disetujui_pada' => now(),
            'disetujui_oleh' => $adminName,
        ]);

        // Generate WhatsApp message for parents
        $message = "🎉 *SELAMAT! PENDAFTARAN DITERIMA*\n\n"
            . "Kepada Yth. Bapak/Ibu {$registration->nama_ayah},\n\n"
            . "Kami dengan senang hati menginformasikan bahwa pendaftaran PPDB untuk:\n"
            . "Nama: *{$registration->nama}*\n"
            . "No. Pendaftaran: {$registration->no_pendaftaran}\n\n"
            . "*TELAH DITERIMA* di SD IT Baitul Ihsan.\n\n"
            . "📅 *Tahap Selanjutnya:*\n"
            . "1. Daftar ulang di sekolah\n"
            . "2. Pembayaran biaya sekolah\n"
            . "3. Orientasi siswa baru\n\n"
            . "📞 Hubungi kami untuk info lebih lanjut:\n"
            . "0822-2583-2575";

        $whatsappUrl = "https://wa.me/62" . substr($registration->no_hp_ayah, 1) . "?text=" . urlencode($message);

        return redirect()->route('admin.registrations.show', $id)
            ->with('success', 'Pendaftaran berhasil disetujui.')
            ->with('whatsapp_url', $whatsappUrl);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $registration = Ppdb::findOrFail($id);

        // Gunakan Auth facade untuk menghindari warning Intelephense
        if (Auth::check()) {
            $adminName = Auth::user()->name;
        } else {
            $adminName = 'System';
        }

        $registration->update([
            'status' => 'ditolak', // PERBAIKAN: ini harus 'ditolak' bukan 'diterima'
            'catatan_admin' => $request->alasan_penolakan, // Simpan alasan penolakan
            'disetujui_pada' => now(),
            'disetujui_oleh' => $adminName,
        ]);

        // Generate WhatsApp message for parents
        $message = "Mohon maaf, pendaftaran PPDB untuk:\n"
            . "Nama: {$registration->nama}\n"
            . "No. Pendaftaran: {$registration->no_pendaftaran}\n\n"
            . "Tidak dapat kami terima dengan alasan:\n"
            . "{$request->alasan_penolakan}\n\n"
            . "Terima kasih atas minat Anda.";

        $whatsappUrl = "https://wa.me/62" . substr($registration->no_hp_ayah, 1) . "?text=" . urlencode($message);

        return redirect()->route('admin.registrations.show', $id)
            ->with('success', 'Pendaftaran berhasil ditolak.')
            ->with('whatsapp_url', $whatsappUrl);
    }

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        $registration = Ppdb::findOrFail($id);
        $registration->update([
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->route('admin.registrations.show', $id)
            ->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $registration = Ppdb::findOrFail($id);

        // Delete files from storage
        Storage::disk('public')->delete([
            $registration->foto_anak,
            $registration->foto_kk,
            $registration->foto_ktp_ayah,
            $registration->foto_ktp_ibu
        ]);

        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $registrations = Ppdb::where('status', 'diterima')->get();

        $data = [
            ['No', 'No Pendaftaran', 'Nama', 'NIK', 'TTL', 'Jenis Kelamin', 'Nama Ayah', 'No HP Ayah', 'Status']
        ];

        foreach ($registrations as $index => $registration) {
            $data[] = [
                $index + 1,
                $registration->no_pendaftaran,
                $registration->nama,
                $registration->nik,
                $registration->tempat_lahir . ', ' . $registration->tanggal_lahir_formatted,
                $registration->jenis_kelamin,
                $registration->nama_ayah,
                $registration->no_hp_ayah,
                $registration->status
            ];
        }

        return response()->streamDownload(function () use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, 'data-ppdb-diterima-' . date('Y-m-d') . '.csv');
    }
}
