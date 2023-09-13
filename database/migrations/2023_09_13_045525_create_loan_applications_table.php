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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('loan_type')->nullable();
            $table->string('application_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->float('additional_charge')->nullable();
            $table->float('amount_requested')->nullable();
            $table->float('loan_amount')->nullable();
            $table->string('tenure')->nullable();
            $table->float('emi')->nullable();
            $table->float('interest_amount')->nullable();
            $table->float('total_amount_paid')->nullable();
            $table->string('rate_of_interest')->nullable();
            $table->date('start_emi')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('loan_applications');
    }
};
