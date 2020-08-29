<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->bigIncrements('product_transaction_id');
            $table->integer('product_id');            
            $table->integer('quantity');
            $table->string('type', 16); // If transaction was made by system or API
            $table->dateTime('created_at');
            $table->timestamps();

            // Add the foreign key and reference the product_id on product table
            $table->foreign('product_id')->references('product_id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_transactions');
    }
}
