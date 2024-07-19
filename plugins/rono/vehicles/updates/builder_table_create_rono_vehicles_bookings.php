<?php namespace Rono\Vehicles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRonoVehiclesBookings extends Migration
{
    public function up()
    {
        Schema::create('rono_vehicles_bookings', function($table)
        {
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_vehicle_types');
            $table->string('prospect_name');
            $table->string('prospect_group');
            $table->string('prospect_company');
            $table->string('prospect_id_karyawan');
            $table->string('prospect_email');
            $table->string('prospect_phone');
            $table->string('prospect_domisili');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rono_vehicles_bookings');
    }
}
