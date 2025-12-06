<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ppdb extends Model
{
    use HasFactory;

    protected $table = 'ppdbs'; // ✅ PASTIKAN sesuai migration

    protected $fillable = [
        'no_pendaftaran',

        // ✅ Data Siswa
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'anak_ke',
        'dari_bersaudara',
        'asal_sekolah',
        'alamat',

        // ✅ Data Orang Tua
        'nama_ayah',
        'nama_ibu',
        'no_hp_ayah',
        'no_hp_ibu',
        'pendapatan',
        'alamat_orang_tua',

        // ✅ Upload
        'foto_anak',
        'foto_kk',
        'foto_akte',
        'foto_ktp_ayah',
        'foto_ktp_ibu',

        // ✅ Status & admin
        'status',
        'catatan_admin',
        'disetujui_pada',
        'disetujui_oleh',
        'sudah_dihubungi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'disetujui_pada' => 'datetime',
        'sudah_dihubungi' => 'boolean',
    ];

    /* ================= ACCESSOR ================= */

    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir
            ? $this->tanggal_lahir->translatedFormat('d F Y')
            : '-';
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'menunggu' => 'Menunggu Verifikasi',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            default => ucfirst($this->status),
        };
    }

    /* ================= FOTO URL ================= */

    protected function fotoUrl($path)
    {
        return $path ? asset('storage/' . $path) : null;
    }

    public function getFotoAnakUrlAttribute()
    {
        return $this->fotoUrl($this->foto_anak);
    }

    public function getFotoKkUrlAttribute()
    {
        return $this->fotoUrl($this->foto_kk);
    }

    public function getFotoAkteUrlAttribute()
    {
        return $this->fotoUrl($this->foto_akte);
    }

    public function getFotoKtpAyahUrlAttribute()
    {
        return $this->fotoUrl($this->foto_ktp_ayah);
    }

    public function getFotoKtpIbuUrlAttribute()
    {
        return $this->fotoUrl($this->foto_ktp_ibu);
    }

    /* ================= SCOPE ================= */

    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeDiterima($query)
    {
        return $query->where('status', 'diterima');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }
}
