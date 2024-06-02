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
        Schema::create('config_lamps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->boolean('status');
            $table->time('time_on');
            $table->time('time_off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_lamps');
    }
};
