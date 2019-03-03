<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_token', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->default('')->comment('用户id');
            $table->string('token')->default('');
            $table->integer('over_time')->default(0)->comment('过期时间');
            $table->integer('add_time')->default(0)->comment('添加时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_token');
    }
}
