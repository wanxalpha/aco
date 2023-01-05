<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicroLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micro_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('package_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('processing_fee')->nullable();
            $table->string('admin_fee')->nullable();
            $table->integer('status')->comment('1=active, 2=non-active');
            $table->string('money_lender_license')->nullable();
            $table->string('advertising_license')->nullable();
            $table->string('loan_agreement')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('micro_loans');
    }
}
