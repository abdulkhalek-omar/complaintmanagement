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
            $table->foreignId('fk_ticket_id')->nullable()->references('id')->on('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_customer_id')->nullable()->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_employee_id')->nullable()->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_keyword_id')->nullable()->references('id')->on('keywords')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('closed')->default(0)->comment('0 => Ticket was not closed, 1 Ticket was closed');
            $table->text('response')->nullable();
            $table->boolean('satisfied')->nullable()->comment('0 => unsatisfied; 1 => satisfied');
            $table->text('comment')->nullable()->comment('The Comment from Customer');
            $table->timestamp('assignment_at')->nullable();
            $table->timestamp('expiry_at')->nullable();
            $table->timestamp('replied_at')->nullable();
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
