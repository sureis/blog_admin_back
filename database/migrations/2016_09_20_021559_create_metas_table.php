<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration
{

//CREATE TABLE `typecho_metas` (
//`mid` int(10) unsigned NOT NULL auto_increment,
//`name` varchar(200) default NULL,
//`slug` varchar(200) default NULL,
//`type` varchar(32) NOT NULL,
//`description` varchar(200) default NULL,
//`count` int(10) unsigned default '0',
//`order` int(10) unsigned default '0',
//`parent` int(10) unsigned default '0',
//PRIMARY KEY  (`mid`),
//KEY `slug` (`slug`)
//) ENGINE=MyISAM  DEFAULT CHARSET=%charset%;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('metas', function ($table) {
            $table->increments('id');
            $table->string('name', 200)->index()->nullable();
            $table->string('slug', 200)->nullable();
            $table->string('type', 32);
            $table->string('description', 200)->nullable();
            $table->integer('count')->unsigned();
            $table->integer('order')->unsigned();
            $table->integer('parent')->unsigned();
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
        //
        Schema::drop('metas');
    }
}
