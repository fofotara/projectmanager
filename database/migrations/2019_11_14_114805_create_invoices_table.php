<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('currentAccount_id');
            $table->foreign('currentAccount_id')->references('id')->on('currentaccounts')->onDelete('cascade');

            $table->string('currencyCode')->nullable();
            $table->decimal('currency',16,4)->default(0);

            $table->decimal('amount',16,2)->default(0);
            $table->decimal('discount',16,2)->default(0);
            $table->decimal('lastAmount',16,2)->default(0);
            $table->decimal('tax',16,2)->default(0);
            $table->decimal('total',16,2)->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
