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
            $table->enum('sector', [
                'AGRI',
                'BASIC-IND',
                'CONSUMER',
                'FINANCE',
                'INFRASTRUCT',
                'MINING',
                'MISC-IND',
                'PROPERTY',
                'TRADE'
            ]);
            $table->string('code');
            $table->string('name');
            $table->timestamp('listing_date');
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
