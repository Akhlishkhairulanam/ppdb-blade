<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->boolean('sudah_dihubungi')
                ->default(false)
                ->after('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ppdbs', function (Blueprint $table) {
            $table->dropColumn('sudah_dihubungi');
        });
    }
};
