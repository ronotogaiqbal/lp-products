<?php namespace Rono\Banners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoBannersVehivles2 extends Migration
{
    public function up()
    {
        Schema::table('rono_banners_vehivles_', function($table)
        {
            $table->integer('is_active');
        });
    }
    
    public function down()
    {
        Schema::table('rono_banners_vehivles_', function($table)
        {
            $table->dropColumn('is_active');
        });
    }
}
