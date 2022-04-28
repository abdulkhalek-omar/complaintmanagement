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
        Schema::create('management_hierarchies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_employee_management_id')->references('id')->on('employee_managements')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_customer_management_id')->references('id')->on('customer_managements')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('reply')->default(0)->comment('0 => not replied; 1 => replied');
            $table->text('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('management_hierarchies');
    }
};
