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
        Schema::create('anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_orangtua')->constrained('ortu')->onDelete('cascade'); 
            $table->string('nik')->unique();
            $table->string('nama', 100);
            $table->integer('jenis_kelamin'); //jadi ini nanti 1 = laki-laki, 0 = perempuan;
            $table->date('tanggal_lahir');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
