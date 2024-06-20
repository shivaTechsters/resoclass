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
        Schema::create('reso_students', function (Blueprint $table) {
            $table->bigIncrements('id')->from('100001');
            $table->string('neet_application_no')->nullable();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('neet_registred_mobile_no')->nullable();
            $table->string('alternate_number')->nullable();
            $table->string('examination_center')->nullable();
            $table->boolean('is_migrated')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reso_students');
    }
};
