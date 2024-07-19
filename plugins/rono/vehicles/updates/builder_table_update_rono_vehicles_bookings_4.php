<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoVehiclesBookings4 extends Migration
{
    public function up()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->string('status', 255)->default('Prospect')->change();
        });
    }
    
    public function down()
    {
        Schema::table('rono_vehicles_bookings', function($table)
        {
            $table->string('status', 255)->default(null)->change();
        });
    }
}
