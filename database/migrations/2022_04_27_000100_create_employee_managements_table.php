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
        Schema::create('employee_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_employee_id')->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_department_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['fk_department_id', 'fk_employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_managements');
    }
};
