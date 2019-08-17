<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('店名');
            $table->text('address')->comment('地址');
            $table->string('city')->comment('城市');
            $table->string('state')->comment('状态');
            $table->string('zip')->comment('邮政编码');
            $table->decimal('latitude', 11, 8)->default(0)->comment('纬度');
            $table->decimal('longitude', 11, 8)->default(0)->comment('经度');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cafes');
    }
}
