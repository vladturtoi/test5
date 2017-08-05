<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('products', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('name', 150)->index();
		    $table->string('type', 150)->index();
		    $table->text('description')->nullable();
		    $table->float('price')->unsigned()->index();
		    $table->float('discount')->unsigned()->nullable()->index();
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
        Schema::drop('products');
    }
}
