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
        Schema::create('user_matkul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('matakuliah_id')
                ->constrained('mata_kuliahs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('uts')->default(0);
            $table->integer('uas')->default(0);
            $table->integer('presensi')->default(0);
            $table->integer('total')->default(0);
            $table->string('nilai')->nullable(true);
            $table->tinyInteger('islulus')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usermatkuls');
    }
};
