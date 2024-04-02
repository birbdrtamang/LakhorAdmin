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
        Schema::create('driversinfo', function (Blueprint $table) {
            $table->id('cid');
            $table->string('name');
            $table->string('licencenumber');
            $table->string('gender');
            $table->string('mobilenumber',8);
            $table->string('vehiclenumber');
            $table->string('vehiclebrand');
            $table->string('vehiclecolor');
            $table->string('vehicletype');
            $table->integer('vehiclecapacity');
            $table->string('filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driversinfo');
    }
};
