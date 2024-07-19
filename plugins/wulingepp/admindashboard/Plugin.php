<?php namespace WulingEPP\AdminDashboard;

use System\Classes\PluginBase;
use Backend\Facades\Backend;
use Illuminate\Support\Facades\Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Admin Dashboard',
            'description' => 'Provides admin dashboard functionality for Wuling EPP',
            'author'      => 'WulingEPP',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($manager) {
            $manager->addSideMenuItems('October.Backend', 'system', [
                'admin_dashboard' => [
                    'label'       => 'Admin Dashboard',
                    'url'         => Backend::url('wulingepp/admindashboard/dashboard'),
                    'icon'        => 'icon-dashboard',
                    'permissions' => ['wulingepp.admindashboard.*'],
                    'order'       => 500,
                ]
            ]);
        });
    }

    public function registerPermissions()
    {
        return [
            'wulingepp.admindashboard.*' => ['label' => 'Manage Admin Dashboard'],
        ];
    }
}