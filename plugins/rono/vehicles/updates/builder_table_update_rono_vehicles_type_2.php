<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesType2 extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_type', function($table)
        {
            $table->string('model', 255);
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_type', function($table)
        {
            $table->dropColumn('model');
        });
    }
}
