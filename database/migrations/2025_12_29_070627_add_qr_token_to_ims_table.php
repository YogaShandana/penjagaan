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
            $table->string('qr_token')->unique()->after('nomor_urut');
            $table->text('qr_code')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ims', function (Blueprint $table) {
            // Check if qr_token column exists before dropping
            if (Schema::hasColumn('ims', 'qr_token')) {
                $table->dropColumn('qr_token');
            }
            // Keep qr_code as text since data might be longer than 255 chars
        });
    }
};
