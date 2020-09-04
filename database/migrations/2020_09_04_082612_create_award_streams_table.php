<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_streams', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->comment('用户id');
            $table->float('change_num')->default(0)->comment('积分变化量');
            $table->integer('source_type')->default(0)->comment('积分类型 1：邀请好友返利,2：被邀请注册返利');
            $table->integer('source_uid')->comment('积分变化来源用户id');
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
        Schema::dropIfExists('award_streams');
    }
}
