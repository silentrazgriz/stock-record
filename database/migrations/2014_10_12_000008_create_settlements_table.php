<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_account_id');
            $table->timestamp('transaction_at');
            $table->timestamp('settled_at');
            $table->bigInteger('amount');
            $table->enum('settlement_type', ['DEPOSIT', 'ORDER']);
            $table->timestamps();

            $table->foreign('user_account_id')
                ->references('id')
                ->on('user_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realizations');
    }
}
