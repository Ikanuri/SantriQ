<?php

use App\Models\Santri;
use App\Models\TahunAkademik;
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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Santri::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TahunAkademik::class)->constrained()->cascadeOnDelete();
            $table->integer('jml_alpha')->default(0);
            $table->integer('jml_sakit')->default(0);
            $table->integer('jml_izin')->default(0);
            $table->integer('jml_hadir')->default(0);
            $table->enum('departemen', ['Diniyah', 'Pengajian']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
