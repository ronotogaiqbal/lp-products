<?php namespace Rono\AdminPanel;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'AdminPanel',
            'description' => 'No description provided yet...',
            'author' => 'Rono',
            'icon' => 'icon-leaf'
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        include_once(__DIR__ . '/routes.php');
    }

    public function registerComponents()
    {
        return [
            'Rono\AdminPanel\Components\LoginForm' => 'loginForm',
        ];
    }

    public function registerPermissions()
    {
        return [
            'rono.adminpanel.some_permission' => [
                'tab' => 'AdminPanel',
                'label' => 'Some permission'
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'adminpanel' => [
                'label' => 'Admin Panel',
                'url' => Backend::url('rono/adminpanel/bookings'),
                'icon' => 'icon-leaf',
                'permissions' => ['rono.adminpanel.*'],
                'order' => 500,
            ],
            'vehicles' => [
                'label' => 'Vehicles',
                'url' => Backend::url('rono/adminpanel/vehicles'),
                'icon' => 'icon-car',
                'permissions' => ['rono.adminpanel.*'],
                'order' => 510,
            ],
            'banners' => [
                'label' => 'Banners',
                'url' => Backend::url('rono/adminpanel/banners'),
                'icon' => 'icon-image',
                'permissions' => ['rono.adminpanel.*'],
                'order' => 520,
            ],
        ];
    }
}
