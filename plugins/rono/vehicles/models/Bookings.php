<?php namespace Rono\Vehicles\Models;

use Model;

/**
 * Model
 */
class Bookings extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'rono_vehicles_bookings';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
