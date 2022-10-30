<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->double('loan_amount',10,5);
            $table->unsignedInteger('no_of_terms');
            $table->unsignedInteger('current_term')->default(0);
            $table->double('minimum_per_term_amount',10,5)->nullable();
            $table->string('status');
            $table->double('paid_amount',10,5)->default(0);
            $table->date('loan_date');
            $table->foreignId('approved_by')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
