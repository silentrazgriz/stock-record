<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->unsignedInteger('previous');
            $table->unsignedInteger('close');
            $table->unsignedInteger('low');
            $table->unsignedInteger('high');
            $table->integer('change');
            $table->decimal('listed_shares', 20, 1);
            $table->decimal('volume', 20, 1);
            $table->decimal('foreign_buy', 20, 1);
            $table->decimal('foreign_sell', 20, 1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
