<?php

namespace App\Http\Controllers;

use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        $total     = Ppdb::count();
        $pending   = Ppdb::where('status', 'menunggu')->count();
        $accepted  = Ppdb::where('status', 'diterima')->count();
        $rejected  = Ppdb::where('status', 'ditolak')->count();

        $recentRegistrations = Ppdb::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total',
            'pending',
            'accepted',
            'rejected',
            'recentRegistrations'
        ));
    }

    /* ================= LIST DATA ================= */

    public function index(Request $request)
    {
        $query = Ppdb::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('no_pendaftaran', 'like', "%$search%")
                    ->orWhere('nik', 'like', "%$search%")
                    ->orWhere('nama_ayah', 'like', "%$search%");
            });
        }

        $registrations = $query->latest()->paginate(20);

        return view('admin.registrations.index', compact('registrations'));
    }

    /* ================= DETAIL ================= */

    public function show($id)
    {
        $registration = Ppdb::findOrFail($id);
        return view('admin.registrations.show', compact('registration'));
    }

    /* ================= APPROVE ================= */

    public function approve(Request $request, $id)
    {
        $ppdb = Ppdb::findOrFail($id);

        $ppdb->update([
            'status' => 'diterima',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
        ]);

        $noHp = '62' . ltrim($ppdb->no_hp_ayah, '0');

        $message = "🎉 *SELAMAT! PENDAFTARAN DITERIMA*\n\n"
            . "Assalamu’alaikum Bapak/Ibu {$ppdb->nama_ayah},\n\n"
            . "Kami dari *PPDB SD IT Baitul Ihsan* menginformasikan bahwa:\n\n"
            . "👧 Nama Siswa : *{$ppdb->nama}*\n"
            . "📄 No Daftar : *{$ppdb->no_pendaftaran}*\n\n"
            . "✅ *DINYATAKAN DITERIMA*\n\n"
            . "📌 Silakan melakukan *daftar ulang* ke sekolah.\n\n"
            . "📞 Admin PPDB\n"
            . "SD IT Baitul Ihsan";

        $waUrl = "https://wa.me/{$noHp}?text=" . urlencode($message);

        return redirect()->away($waUrl);
    }
    public function reject(Request $request, $id)
    {
        $ppdb = Ppdb::findOrFail($id);

        $ppdb->update([
            'status' => 'ditolak',
            'disetujui_pada' => now(),
            'disetujui_oleh' => Auth::user()->name,
            'sudah_dihubungi' => 1,
        ]);

        $noHp = '62' . ltrim($ppdb->no_hp_ayah, '0');

        $message = "Assalamu’alaikum Bapak/Ibu {$ppdb->nama_ayah},\n\n"
            . "Terima kasih telah mendaftar *PPDB SD IT Baitul Ihsan*.\n\n"
            . "Setelah proses seleksi, pendaftaran atas:\n\n"
            . "👧 Nama : *{$ppdb->nama}*\n"
            . "📄 No Daftar : *{$ppdb->no_pendaftaran}*\n\n"
            . "❌ *BELUM DAPAT KAMI TERIMA*\n\n"
            . "Semoga Allah menggantinya dengan yang lebih baik.\n\n"
            . "Hormat kami,\n"
            . "Admin PPDB SD IT Baitul Ihsan";

        $waUrl = "https://wa.me/{$noHp}?text=" . urlencode($message);

        return redirect()->away($waUrl);
    }

    /* ================= UPDATE CATATAN ================= */

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:1000'
        ]);

        $registration = Ppdb::findOrFail($id);
        $registration->update([
            'catatan_admin' => $request->catatan_admin
        ]);

        return back()->with('success', 'Catatan diperbarui.');
    }

    /* ================= HAPUS DATA ================= */

    public function destroy($id)
    {
        $registration = Ppdb::findOrFail($id);

        Storage::disk('public')->delete([
            $registration->foto_anak,
            $registration->foto_kk,
            $registration->foto_ktp_ayah,
            $registration->foto_ktp_ibu,
        ]);

        $registration->delete();

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    /* ================= EXPORT ================= */

    public function export()
    {
        $registrations = Ppdb::where('status', 'diterima')->get();

        $data = [[
            'No',
            'No Pendaftaran',
            'Nama',
            'NIK',
            'TTL',
            'JK',
            'Nama Ayah',
            'No HP',
            'Status'
        ]];

        foreach ($registrations as $i => $r) {
            $data[] = [
                $i + 1,
                $r->no_pendaftaran,
                $r->nama,
                $r->nik,
                $r->tempat_lahir . ', ' . $r->tanggal_lahir,
                $r->jenis_kelamin,
                $r->nama_ayah,
                $r->no_hp_ayah,
                $r->status,
            ];
        }

        return response()->streamDownload(function () use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }, 'ppdb-diterima-' . date('Y-m-d') . '.csv');
    }
}
