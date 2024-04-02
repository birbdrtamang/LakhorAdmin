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
        Schema::create('routeaccepted', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('d_cid');
            $table->string('d_name');
            $table->bigInteger('p_cid');
            $table->string('p_name');
            $table->string('pickup');
            $table->string('destination');
            $table->integer('fare');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routeaccepted');
    }
};
