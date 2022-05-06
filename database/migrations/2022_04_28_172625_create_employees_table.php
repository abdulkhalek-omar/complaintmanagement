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
            $table->foreignId('fk_user_id')->nullable()->unique()->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone_nr', 30)->nullable()->unique();
            $table->string('street', )->nullable();
            $table->string('Hnr', '5')->nullable();
            $table->foreignId('fk_state_id')->nullable()->references('id')->on('states')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('fk_department_id')->nullable()->references('id')->on('departments')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('is_active')->default(1)->comment('1 => User Active; 0 => User Inactive');
            $table->boolean('is_admin')->default(1)->comment('1 => Admin; 0 => User');
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
