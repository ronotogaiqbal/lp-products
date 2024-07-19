<?php namespace Rono\Banners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoBanners extends Migration
{
    public function up()
    {
        Schema::create('rono_banners_', function($table)
        {
            $table->increments('id')->unsigned();
            $table->text('link');
            $table->text('image_path');
            $table->smallInteger('order')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_banners_');
    }
}
