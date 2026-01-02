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
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('guid')->nullable();
            $table->string('guid_text')->nullable();
            $table->integer('album_id')->nullable();
            $table->string('pdf')->nullable();
            $table->string('jns', 2)->default('b');
            $table->integer('kategori')->default(1);
            $table->integer('klik')->default(0);
            $table->string('slug')->nullable();
            $table->integer('popup')->default(0);
            $table->enum('publish', ['N', 'Y'])->default('N');
            $table->dateTime('publish_at', $precision = 0)->nullable();
            $table->dateTime('content_at', $precision = 0)->nullable();
            $table->string('pubid')->nullable();
            $table->string('crid');
            $table->string('upid')->nullable();
            $table->string('crname')->nullable();
            $table->string('upname')->nullable();
            $table->string('pubname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten');
    }
};
