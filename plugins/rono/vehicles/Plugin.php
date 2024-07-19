<?php namespace Rono\Vehicles;

use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            \Rono\Vehicles\Components\ListVehicles::class=>'listVehicles',
            \Rono\Vehicles\Components\BookingForm::class=>'bookingForm',
            \Acme\Cars\Components\CarList::class=>'carList',
        ];
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }
}
