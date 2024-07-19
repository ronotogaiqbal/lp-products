<?php namespace Rono\AdminPanel\Components;

use Cms\Classes\ComponentBase;

class LoginForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Login Form',
            'description' => 'Admin panel login form'
        ];
    }

    public function onRun()
    {
        $this->page['actionUrl'] = url('backend/rono/adminpanel/auth/authenticate');
    }
}
