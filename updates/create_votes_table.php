<?php namespace SunLab\UpDown\Updates;

use Winter\Storm\Support\Facades\Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_updown_votes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('votable_type');
            $table->unsignedInteger('votable_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->tinyInteger('vote');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_updown_votes');
    }
}
