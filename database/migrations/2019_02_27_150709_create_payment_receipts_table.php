<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registration_id')->unsigned();
            $table->string('name');
            $table->string('account')->nullable();
            $table->string('bank')->nullable();
            $table->integer('nominal')->unsigned()->nullable();
            $table->date('paid_at')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_receipts');
    }
}
