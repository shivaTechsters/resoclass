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
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id')->from('100001');
            $table->string('neet_application_no')->nullable();
            $table->string('reso_admit_card_no')->nullable();
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('neet_reg_phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->foreignId('examination_center_id')->nullable()->references('id')->on('examination_centers');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
