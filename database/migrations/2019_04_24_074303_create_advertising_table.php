<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('advertising', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('image');
            $table->boolean('popup')->default(0);
            $table->boolean('home')->default(0);
            $table->boolean('single')->default(0);
            $table->enum('is_active',['0','1']);
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
        Schema::dropIfExists('advertising');
    }
}
