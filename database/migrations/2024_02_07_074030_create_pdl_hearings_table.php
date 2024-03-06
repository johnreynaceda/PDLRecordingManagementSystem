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
        Schema::create('pdl_hearings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdl_id');
            $table->date('date_of_hearing');

            $table->dateTime('time_of_hearing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdl_hearings');
    }
};
