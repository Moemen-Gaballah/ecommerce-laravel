<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->string('country_made');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('Rating')->default(0);
            $table->smallInteger('approve')->default(0);
            $table->string('tags')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
