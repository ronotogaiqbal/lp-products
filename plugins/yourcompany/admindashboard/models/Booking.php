<?php namespace YourCompany\AdminDashboard\Models;

use Model;

/**
 * Booking Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Booking extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'yourcompany_admindashboard_bookings';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
