<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{

//CREATE TABLE `typecho_contents` (
//`cid` int(10) unsigned NOT NULL auto_increment,
//`title` varchar(200) default NULL,
//`slug` varchar(200) default NULL,
//`created` int(10) unsigned default '0',
//`modified` int(10) unsigned default '0',
//`text` text,
//`order` int(10) unsigned default '0',
//`authorId` int(10) unsigned default '0',
//`template` varchar(32) default NULL,
//`type` varchar(16) default 'post',
//`status` varchar(16) default 'publish',
//`password` varchar(32) default NULL,
//`commentsNum` int(10) unsigned default '0',
//`allowComment` char(1) default '0',
//`allowPing` char(1) default '0',
//`allowFeed` char(1) default '0',
//`parent` int(10) unsigned default '0',
//PRIMARY KEY  (`cid`),
//UNIQUE KEY `slug` (`slug`),
//KEY `created` (`created`)
//) ENGINE=MyISAM  DEFAULT CHARSET=%charset%;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contents', function ($table) {
            $table->increments('id');
            $table->string('title', 200)->index();
            $table->string('slug', 200)->nullable();
            $table->string('text_url', 200)->nullable();
            $table->string('tag', 200)->nullable();
            $table->text('text');
            $table->integer('order')->unsigned();
            $table->integer('authorId')->references('id')->on('users');
            $table->string('type', 16);
            $table->string('status', 16);
            $table->string('password', 32);
            $table->char('allowComment', 1);
            $table->char('allowPing', 1);
            $table->char('allowFeed', 1);
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
        Schema::drop('contents');
    }
}
