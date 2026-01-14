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
            // Check if nomor_urut unique constraint exists before dropping
            $nomorUrutExists = \DB::select(
                "SHOW INDEX FROM ims WHERE Key_name = 'ims_nomor_urut_unique'"
            );
            
            if (!empty($nomorUrutExists)) {
                $table->dropUnique(['nomor_urut']);
            }
            
            // Check if composite unique constraint already exists
            $compositeExists = \DB::select(
                "SHOW INDEX FROM ims WHERE Key_name = 'ims_nomor_urut_role_unique'"
            );
            
            // Tambah composite unique constraint untuk nomor_urut + role_type if not exists
            if (empty($compositeExists)) {
                $table->unique(['nomor_urut', 'role_type'], 'ims_nomor_urut_role_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the composite unique constraint exists
        $constraintExists = \DB::select(
            "SHOW INDEX FROM ims WHERE Key_name = 'ims_nomor_urut_role_unique'"
        );
        
        Schema::table('ims', function (Blueprint $table) use ($constraintExists) {
            // Drop composite unique constraint if it exists
            if (!empty($constraintExists)) {
                $table->dropUnique('ims_nomor_urut_role_unique');
            }
            
            // Don't restore the old constraint during rollback
            // because there might be duplicate values in the table
        });
    }
};
