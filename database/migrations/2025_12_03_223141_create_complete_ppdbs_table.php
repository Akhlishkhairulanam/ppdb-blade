<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();

            // Nomor Pendaftaran
            $table->string('no_pendaftaran')->unique();

            // Data Calon Siswa
            $table->string('nama');
            $table->string('nik', 16)();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('anak_ke');
            $table->integer('dari_bersaudara');
            $table->string('asal_sekolah');
            $table->text('alamat');

            // Data Orang Tua
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_hp_ayah', 15);
            $table->string('no_hp_ibu', 15);
            $table->string('pendapatan', 50);
            $table->text('alamat_orang_tua');

            // File Uploads
            $table->string('foto_anak')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_akte')->nullable();
            $table->string('foto_ktp_ayah')->nullable();
            $table->string('foto_ktp_ibu')->nullable();

            // Status & Admin
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('disetujui_pada')->nullable();
            $table->string('disetujui_oleh')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('no_pendaftaran');
            $table->index('created_at');
            $table->index('nik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
