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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ledger_id')->default(0);
            $table->bigInteger('loan_id')->default(0);
            $table->bigInteger('enquiry_id')->default(0);
            $table->longText('description')->nullable();
            $table->enum('type',['dr','cr'])->default('dr');
            $table->float('amount')->default(0);
            $table->string('group_id')->nullable();
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
        Schema::dropIfExists('journal_entries');
    }
};
