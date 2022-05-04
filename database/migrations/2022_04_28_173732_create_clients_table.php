<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->string('phone_nr', 30)->nullable()->unique();
            $table->string('password');
            $table->string('street')->nullable();
            $table->string('Hnr', '5')->nullable();
            $table->foreignId('fk_state_id')->nullable()->references('id')->on('states')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('is_active')->default(1)->comment('1 => User Active; 0 => User Inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
