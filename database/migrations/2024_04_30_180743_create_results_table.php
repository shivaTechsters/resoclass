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
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id')->from('100001');
            $table->string('admit_card_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('bot_marks')->nullable();
            $table->string('zoo_marks')->nullable();
            $table->string('phy_marks')->nullable();
            $table->string('che_marks')->nullable();
            $table->string('total_marks')->nullable();
            $table->string('percentage')->nullable();
            $table->string('rank')->nullable();
            $table->boolean('is_message_sent')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
