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
            $table->timestamp('done_at')->nullable();
            $table->timestamp('settled_at')->nullable();
            $table->bigInteger('buy_amount');
            $table->bigInteger('sell_amount');
            $table->bigInteger('net_amount');
            $table->enum('settlement_type', ['DEPOSIT', 'WITHDRAW', 'ORDER']);
            $table->boolean('is_realized')->default(false);
            $table->timestamps();

            $table->foreign('user_account_id')
                ->references('id')
                ->on('user_accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
