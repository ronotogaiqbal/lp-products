<?php namespace Rono\Users\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoUsers extends Migration
{
    public function up()
    {
        Schema::create('rono_users_', function($table)
        {
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('username');
            $table->string('password');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_users_');
    }
}
