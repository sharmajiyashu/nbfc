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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('address')->nullable();
            $table->longText('address_2')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('login_charge')->nullable();
            $table->string('pay_mode')->nullable();
            $table->longText('pay_mode_desc')->nullable();
            $table->longText('comment')->nullable();
            $table->enum('status',['pending','approved','reject'])->default('pending');
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
        Schema::dropIfExists('enquiries');
    }
};
