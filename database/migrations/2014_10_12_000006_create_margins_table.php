<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('margins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_account_id');
            $table->bigInteger('total_margin');
            $table->bigInteger('total_interest');
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
        Schema::dropIfExists('margins');
    }
}
