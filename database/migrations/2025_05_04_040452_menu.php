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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('keterangan', 200)->nullable();
            $table->string('guid', 50)->nullable();
            $table->integer('ref')->default(0);
            $table->integer('jns');
            $table->integer('kategori')->default(1);
            $table->string('target')->default("#");
            $table->string('crid');
            $table->string('upid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
