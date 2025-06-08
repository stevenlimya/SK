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
        Schema::create('loker', function (Blueprint $table) {
            $table->id();
            $table->string('judul',100)->nullable();
            $table->string('deskripsi1',100)->nullable();
            $table->string('deskripsi2',100)->nullable();
            $table->string('deskripsi3',100)->nullable();
            $table->string('deskripsi4',100)->nullable();
            $table->string('persyaratan1',100)->nullable();
            $table->string('persyaratan2',100)->nullable();
            $table->string('persyaratan3',100)->nullable();
            $table->string('persyaratan4',100)->nullable();
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
        Schema::dropIfExists('loker');
    }
};
