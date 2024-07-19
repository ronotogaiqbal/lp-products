<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesBookings2 extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->renameColumn('id_vehicle_types', 'vehicle_types_id');
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->renameColumn('vehicle_types_id', 'id_vehicle_types');
        });
    }
}
