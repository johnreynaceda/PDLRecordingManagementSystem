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
        Schema::create('pdls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jail_id');
            $table->date('date_arrested');
            $table->string('criminal_case_no');
            $table->date('date_of_confinement');
            $table->string('court');
            $table->string('time');
            $table->string('photo_path');
            $table->date('date_of_hearing')->nullable();
            $table->date('date_of_remand')->nullable();
            $table->date('date_of_release')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdls');
    }
};
