<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesBookings extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->boolean('test_drive');
            $table->boolean('tc_checked');
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->dropColumn('test_drive');
            $table->dropColumn('tc_checked');
        });
    }
}
