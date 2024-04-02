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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('licencenumber');
            $table->bigInteger('cid');
            $table->string('gender');
            $table->string('mobilenumber',8);
            $table->string('photo')->nullable();
            $table->string('vehiclenumber');
            $table->string('vehiclebrand');
            $table->string('vehiclecolor');
            $table->string('vehicletype');
            $table->integer('vehiclecapacity');
            $table->string('bankaccount');
            $table->string('accountnumber');
            $table->string('qrcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
