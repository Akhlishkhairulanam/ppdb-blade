<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ppdbs')) {
            Schema::create('ppdbs', function (Blueprint $table) {
                $table->id();
                $table->string('no_pendaftaran')->unique()->nullable();
                $table->string('nama');
                $table->string('nik', 16)->unique();
                $table->string('tempat_lahir');
                $table->date('tanggal_lahir');
                $table->integer('umur');
                $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
                $table->integer('anak_ke');
                $table->integer('dari_bersaudara');
                $table->string('asal_sekolah');
                $table->text('alamat');
                $table->string('email')->nullable()->unique();

                // Data orang tua
                $table->string('nama_ayah');
                $table->string('nama_ibu');
                $table->string('no_hp_ayah', 15);
                $table->string('no_hp_ibu', 15);
                $table->string('pendapatan');
                $table->text('alamat_orang_tua');

                // Upload file
                $table->string('foto_anak');
                $table->string('foto_kk');
                $table->string('foto_akte');
                $table->string('foto_ktp_ayah');
                $table->string('foto_ktp_ibu');

                // Status dan admin
                $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
                $table->text('catatan_admin')->nullable();
                $table->timestamp('disetujui_pada')->nullable();
                $table->string('disetujui_oleh')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            // Jika tabel sudah ada, tambahkan kolom yang mungkin belum ada
            Schema::table('ppdbs', function (Blueprint $table) {
                if (!Schema::hasColumn('ppdbs', 'email')) {
                    $table->string('email')->nullable()->unique()->after('alamat');
                }
                if (!Schema::hasColumn('ppdbs', 'foto_akte')) {
                    $table->string('foto_akte')->after('foto_kk');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('ppdbs');
    }
};
