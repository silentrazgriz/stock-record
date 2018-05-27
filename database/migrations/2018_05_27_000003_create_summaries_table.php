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
            $table->unsignedInteger('quote_id');
            $table->unsignedInteger('previous');
            $table->unsignedInteger('open');
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
