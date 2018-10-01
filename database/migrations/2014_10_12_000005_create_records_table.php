<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_account_id');
            $table->unsignedInteger('quote_id');
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('total_shares');
            $table->unsignedBigInteger('broker_fee');
            $table->enum('type', ['BUY', 'SELL']);
            $table->timestamp('transaction_date');
            $table->timestamps();

            $table->foreign('user_account_id')
                ->references('id')
                ->on('user_accounts');
            $table->foreign('quote_id')
                ->references('id')
                ->on('quotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
