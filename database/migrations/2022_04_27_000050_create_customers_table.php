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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_user_id')->nullable()->unique()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('surname');
            $table->string('firstname');
            $table->string('phone_number', 30)->nullable()->unique();
            $table->string('street', '150')->nullable();
            $table->foreignId('fk_place_id')->references('id')->on('Places')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fk_state_id')->references('id')->on('States')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fk_country_id')->references('id')->on('Countries')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamp('registered_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
