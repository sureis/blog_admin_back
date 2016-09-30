<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
//CREATE TABLE `typecho_users` (
//`uid` int(10) unsigned NOT NULL auto_increment,
//`name` varchar(32) default NULL,
//`password` varchar(64) default NULL,
//`mail` varchar(200) default NULL,
//`url` varchar(200) default NULL,
//`screenName` varchar(32) default NULL,
//`created` int(10) unsigned default '0',
//`activated` int(10) unsigned default '0',
//`logged` int(10) unsigned default '0',
//`group` varchar(16) default 'visitor',
//`authCode` varchar(64) default NULL,
//PRIMARY KEY  (`uid`),
//UNIQUE KEY `name` (`name`),
//UNIQUE KEY `mail` (`mail`)
//) ENGINE=MyISAM  DEFAULT CHARSET=%charset%;

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email')->unique()->index();
            $table->string('phone', 11)->unique()->index();
            $table->string('name', 50)->index();
            $table->integer('type');
            $table->string('password');
            $table->string('url', 200);
            $table->string('screenName', 32);
            $table->string('avatar', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
