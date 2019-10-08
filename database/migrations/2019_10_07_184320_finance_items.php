<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinanceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('itemId');
            $table->string('tableId');
            $table->string('userId');
            $table->string('personId');
            $table->string('categoryId');
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->string('store');
            $table->mediumText('note')->nullable();
            $table->string('countryCode');
            $table->string('location');
            $table->string('keywords')->nullable();
            $table->double('payed',3,2); // Percentage payed 0-1
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
        //
        Schema::drop('items');
    }
}
