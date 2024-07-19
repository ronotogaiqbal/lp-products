<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesBookings3 extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->string('status', 255);
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
