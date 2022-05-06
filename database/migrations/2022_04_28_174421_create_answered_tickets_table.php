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
        Schema::create('answered_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_ticket_id')->nullable()->references('id')->on('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_employee_id')->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('replied')->default(0)->comment('0 => not replied; 1 => replied');
            $table->text('answer')->nullable();
            $table->timestamp('answered_at')->useCurrent();
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
        Schema::dropIfExists('answered__tickets');
    }
};
