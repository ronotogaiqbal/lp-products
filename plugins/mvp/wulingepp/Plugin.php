<?php namespace MVP\WulingEPP;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Wuling EPP',
            'description' => 'Admin dashboard for Wuling EPP landing page',
            'author' => 'MVP',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerNavigation()
    {
        return [
            'wulingepp' => [
                'label' => 'Wuling EPP',
                'url' => Backend::url('mvp/wulingepp/dashboard'),
                'icon' => 'icon-leaf',
                'permissions' => ['mvp.wulingepp.*'],
                'order' => 500,
            ],
        ];
    }
}