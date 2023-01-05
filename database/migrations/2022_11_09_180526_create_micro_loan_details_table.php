<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micro_loan_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('micro_loan_id');
            $table->string('tenure_month')->nullable();
            $table->string('member_rate')->nullable();
            $table->string('non_member_rate')->nullable();
            $table->string('member_monthly_payment')->nullable();
            $table->string('member_first_month_payment')->nullable();
            $table->string('non_member_monthly_payment')->nullable();
            $table->string('non_member_first_month_payment')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micro_loan_details');
    }
}
