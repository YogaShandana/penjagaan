<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ims', function (Blueprint $table) {
            // Clear existing data and change column type
            $table->string('qr_code')->nullable()->change();
        });
        
        // Clear existing QR code data since format changed
        DB::table('ims')->update(['qr_code' => null]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ims', function (Blueprint $table) {
            $table->text('qr_code')->nullable()->change();
        });
    }
};
