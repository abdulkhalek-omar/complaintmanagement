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
        Schema::create('customer_managements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_ticket_id')->nullable()->references('id')->on('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_customer_id')->nullable()->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_employee_id')->nullable()->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_keyword_id')->nullable()->references('id')->on('keywords')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('closed')->default(0)->comment('0 => Ticket closed, 1 Ticket closed');
            $table->text('response')->nullable();
            $table->boolean('replied')->default(0)->comment('0 => not replied; 1 => replied');
            $table->text('comment')->nullable()->comment('The Comment from Customer');
            $table->timestamp('assignment_at')->nullable();
            $table->timestamp('expiry_at')->nullable();
            $table->timestamp('replied_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_managements');
    }
};
