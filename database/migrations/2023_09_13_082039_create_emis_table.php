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
        Schema::create('emis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id');
            $table->string('emi_number');
            $table->float('emi')->default(0);
            $table->float('due_amount')->default(0);
            $table->float('interest')->default(0);
            $table->float('principal')->default(0);
            $table->string('status')->default(0);
            $table->date('partial_date')->nullable();
            $table->date('emi_date')->nullable();
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
        Schema::dropIfExists('emis');
    }
};
