<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_pendaftaran',
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
        'alamat_orang_tua',
        'nama_ayah',
        'nama_ibu',
        'no_hp_ayah',
        'no_hp_ibu',
        'pendapatan',
        'foto_anak',
        'foto_kk',
        'foto_akte',
        'foto_ktp_ayah',
        'foto_ktp_ibu',
        'status',
        'catatan_admin',
        'disetujui_pada',
        'disetujui_oleh',
        'email'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'disetujui_pada' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = ['status_label', 'tanggal_lahir_formatted'];

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'menunggu' => 'Menunggu Verifikasi',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak'
        ];

        return $statuses[$this->attributes['status']] ?? $this->attributes['status'];
    }

    // Accessor untuk tanggal lahir formatted
    public function getTanggalLahirFormattedAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d F Y') : null;
    }

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'diterima');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'ditolak');
    }
}
