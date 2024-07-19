<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesType extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_type', function($table)
        {
            $table->renameColumn('id_vehicles', 'vehicles_id');
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_type', function($table)
        {
            $table->renameColumn('vehicles_id', 'id_vehicles');
        });
    }
}
