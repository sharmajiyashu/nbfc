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
        Schema::create('emi_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id')->nullable();
            $table->bigInteger('emi_id')->nullable();
            $table->float('amount')->nullable();
            $table->float('interest')->nullable();
            $table->float('principal')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('emi_transactions');
    }
};
