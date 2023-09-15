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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->float('amount')->nullable();
            $table->float('interest')->nullable();
            $table->float('principal')->nullable();
            $table->float('penalty_amount')->nullable();
            $table->string('penalty_day')->nullable();
            $table->float('net_amount')->nullable();
            $table->longText('comment')->nullable();
            $table->string('emi_count')->nullable();
            $table->string('emi_ids')->nullable();
            $table->string('payment_mode')->nullable();
            $table->longText('payment_mode_dsc')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
