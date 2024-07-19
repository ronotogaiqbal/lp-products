<?php namespace Rono\Banners\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRonoBannersVehivles extends Migration
{
    public function up()
    {
        Schema::rename('rono_banners_vehivles', 'rono_banners_vehivles_');
    }
    
    public function down()
    {
        Schema::rename('rono_banners_vehivles_', 'rono_banners_vehivles');
    }
}
