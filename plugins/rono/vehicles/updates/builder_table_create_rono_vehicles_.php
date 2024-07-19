<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoVehicles extends Migration
{
    public function up()
    {
        Schema::create('rono_vehicles_', function($table)
        {
            $table->increments('id')->unsigned();
            $table->text('name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('order_view');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_vehicles_');
    }
}
