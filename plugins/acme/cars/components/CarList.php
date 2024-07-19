<?php namespace Acme\Cars\Components;

use Cms\Classes\ComponentBase;

/**
 * CarList Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CarList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Car List Component',
            'description' => 'No description provided yet...'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }
}
