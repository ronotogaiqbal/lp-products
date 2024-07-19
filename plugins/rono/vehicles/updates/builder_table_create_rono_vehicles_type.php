<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoVehiclesType extends Migration
{
    public function up()
    {
        Schema::create('rono_vehicles_type', function($table)
        {
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_vehicles');
            $table->string('name_type');
            $table->string('fuel');
            $table->string('transmission');
            $table->string('image_path');
            $table->string('link_brochure');
            $table->integer('price');
            $table->integer('discount');
            $table->string('link_more');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_vehicles_type');
    }
}
