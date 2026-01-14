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
        Schema::table('ims', function (Blueprint $table) {
            $table->enum('role_type', ['penjaga', 'mesin'])->default('penjaga')->after('nomor_urut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ims', function (Blueprint $table) {
            $table->dropColumn('role_type');
        });
    }
};
