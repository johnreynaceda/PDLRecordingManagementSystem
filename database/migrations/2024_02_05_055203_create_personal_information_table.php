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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdl_id');
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('residence')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('sex')->nullable();
            $table->string('no_of_children')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_birthplace')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_birthplace')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('first_relative')->nullable();
            $table->string('relationship')->nullable();
            $table->string('relative_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
