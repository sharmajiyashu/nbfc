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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enquiry_id');
            $table->string('allpication_id')->nullable();
            $table->date('enrollment_date');
            $table->string('branch')->nullable();
            $table->string('reference')->nullable();
            $table->string('processing_fees')->default(0);
            $table->string('payment_mode')->nullable();
            $table->longText('payment_mode_desc')->nullable();
            $table->string('loan_amount')->default(0);
            $table->string('rate_of_interest')->nullable();
            $table->string('tenure')->nullable();
            $table->string('loan_type')->nullable();
            $table->date('application_date');
            $table->string('additional_charge')->nullable();
            $table->string('emi_amount')->nullable();
            $table->string('status')->default(0)->comment('0 => Pending');
            $table->longText('reject_reason')->nullable();
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
        Schema::dropIfExists('application_forms');
    }
};
