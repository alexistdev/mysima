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
        Schema::create('forward_chainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('isSKSLulus')->default(0);
            $table->tinyInteger('isBayar')->default(0);
            $table->tinyInteger('isPkpm')->default(0);
            $table->tinyInteger('isMetopel')->default(0);
            $table->integer('jumlahsks')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forward_chainings');
    }
};
