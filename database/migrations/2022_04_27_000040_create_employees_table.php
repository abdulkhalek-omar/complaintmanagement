<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('firstname');
            $table->string('email')->unique();
            $table->string('phone_number', 30)->nullable()->unique();
            $table->string('password');
            $table->unsignedSmallInteger('gender')->nullable();
            $table->string('street', '150')->nullable();
            $table->foreignId('fk_place_id')->references('id')->on('Places')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fk_state_id')->references('id')->on('States')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fk_country_id')->references('id')->on('Countries')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('is_active')->default(1)->comment('1 => User Active; 0 => User Inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('hired_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
