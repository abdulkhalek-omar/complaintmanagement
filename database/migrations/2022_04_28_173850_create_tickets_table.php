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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_client_id')->references('id')->on('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_keyword_id')->nullable()->references('id')->on('keywords')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fk_complaint_id')->nullable()->references('id')->on('complaints')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('closed')->default(0)->comment('0 -> open; 1 -> closed');
            $table->timestamp('closed_at')->useCurrent();
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
        Schema::dropIfExists('tickets');
    }
};
