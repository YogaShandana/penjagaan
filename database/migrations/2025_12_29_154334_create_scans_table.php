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
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->string('qr_token');
            $table->string('scanned_type')->nullable(); // 'ims', 'mjs', or 'unknown'
            $table->unsignedBigInteger('scanned_id')->nullable(); // id of ims or mjs
            $table->string('nama_pos')->nullable();
            $table->string('nomor_urut')->nullable();
            $table->string('status')->default('valid'); // valid, invalid
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('qr_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};
