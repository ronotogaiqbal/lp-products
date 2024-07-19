<?php namespace Rono\Banners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoBannersVehivles extends Migration
{
    public function up()
    {
        Schema::create('rono_banners_vehivles_', function($table)
        {
            $table->increments('id')->unsigned();
            $table->text('merk');
            $table->text('type');
            $table->text('foto');
            $table->boolean('is_active');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_banners_vehivles_');
    }
}
