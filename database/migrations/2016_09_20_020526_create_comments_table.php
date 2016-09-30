<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
//CREATE TABLE `typecho_comments` (
//`coid` int(10) unsigned NOT NULL auto_increment,
//`cid` int(10) unsigned default '0',
//`created` int(10) unsigned default '0',
//`author` varchar(200) default NULL,
//`authorId` int(10) unsigned default '0',
//`ownerId` int(10) unsigned default '0',
//`mail` varchar(200) default NULL,
//`url` varchar(200) default NULL,
//`ip` varchar(64) default NULL,
//`agent` varchar(200) default NULL,
//`text` text,
//`type` varchar(16) default 'comment',
//`status` varchar(16) default 'approved',
//`parent` int(10) unsigned default '0',
//PRIMARY KEY  (`coid`),
//KEY `cid` (`cid`),
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
        Schema::create('comments', function ($table) {
            $table->increments('id');
            $table->integer('cid')->references('id')->on('contents');
            $table->string('author', 50)->index();
            $table->integer('authorId')->references('id')->on('users');
            $table->integer('ownerId')->unsigned();
            $table->string('mail', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('ip', 50)->nullable();
            $table->string('agent', 50)->nullable();
            $table->text('text');
            $table->integer('order')->unsigned();
            $table->string('type', 16);
            $table->string('status', 16);
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
        Schema::drop('comments');
    }
}
