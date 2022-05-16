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
            $table->foreignId('fk_employee_id')->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_customer_id')->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_ticket_id')->references('id')->on('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('closed')->default(0)->comment('0 => Ticket was not closed, 1 Ticket was closed');
            $table->boolean('replied')->default(0)->comment('0 => not replied; 1 => replied');
            $table->text('answer')->nullable();
            $table->timestamp('replied_at')->useCurrent();
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
