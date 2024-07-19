<?php namespace BlakeJones\MagicForms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateBlakejonesMagicformsBookings extends Migration
{
    public function up()
    {
        Schema::create('blakejones_magicforms_bookings_', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('nama');
            $table->text('alamat');
            $table->string('type');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blakejones_magicforms_bookings_');
    }
}
