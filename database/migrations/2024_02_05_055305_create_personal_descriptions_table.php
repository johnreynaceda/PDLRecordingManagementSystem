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
        Schema::create('personal_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdl_id');
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('build')->nullable();
            $table->string('complexion')->nullable();
            $table->string('hair')->nullable();
            $table->string('eyes')->nullable();
            $table->string('religion')->nullable();
            $table->string('occupation')->nullable();
            $table->string('attaintment')->nullable();
            $table->string('nationality')->nullable();
            $table->string('aliases')->nullable();
            $table->string('register_voter')->nullable();
            $table->string('brgy_registration')->nullable();
            $table->string('language')->nullable();
            $table->string('skills')->nullable();
            $table->date('returning_rate')->nullable();
            $table->longText('sentence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_descriptions');
    }
};
