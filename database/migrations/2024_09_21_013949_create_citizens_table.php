<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(false);
            $table->string('nik')->nullable(false)->unique('unique_nik_index');
            $table->string('no_kk')->nullable(false)->unique('unique_no_kk_index');
            $table->string('foto_ktp')->nullable(false);
            $table->string('foto_kk')->nullable(false);
            $table->integer('umur')->nullable(false);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable(false);
            $table->string('provinsi')->nullable(false);
            $table->string('kab_kota')->nullable(false);
            $table->string('kecamatan')->nullable(false);
            $table->string('kelurahan')->nullable(false);
            $table->string('alamat')->nullable(false);
            $table->string('rt')->nullable(false);
            $table->string('rw')->nullable(false);
            $table->string('b_penghasilan')->nullable(false);
            $table->string('s_penghasilan')->nullable(false);
            $table->text('alasan')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
