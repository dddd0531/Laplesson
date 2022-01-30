<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->text('hosoku')->nullable();
            $table->string('hosokutitle1')->nullable();
            $table->text('hosoku1')->nullable();
            $table->string('hosokutitle2')->nullable();
            $table->text('hosoku2')->nullable();            
            $table->string('hosokutitle3')->nullable();
            $table->text('hosoku3')->nullable();            
            $table->string('hosokutitle4')->nullable();
            $table->text('hosoku4')->nullable();
            $table->timestamps();
            $table->string('movie');
            $table->integer('category_id');
            $table->string('contents');
            $table->integer('released')->default(1);
            $table->integer('usersonly')->default(1); 
            $table->integer('imageflag')->default(0);
            $table->integer('squareflag')->nullable();
            $table->integer('refer4')->nullable();
            $table->integer('refer3')->nullable();
            $table->integer('refer2')->nullable();
            $table->integer('refer1')->nullable();
            $table->string('playtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
