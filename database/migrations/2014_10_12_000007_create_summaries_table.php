<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_account_id');
            $table->unsignedInteger('quote_id');
            $table->unsignedInteger('average_price');
            $table->unsignedBigInteger('total_shares');
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
        Schema::dropIfExists('summaries');
    }
}
