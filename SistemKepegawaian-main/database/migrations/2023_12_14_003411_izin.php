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
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('karyawan_id')->nullable();
            $table->string('nama',100)->nullable();
            $table->string('divisi', 50)->nullable();
            $table->string('keterangan',100)->nullable();
            $table->string('status',100)->nullable();
            $table->string('lama',100)->nullable();
            $table->date('tanggal');
            $table->string('acc',100)->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();  
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
