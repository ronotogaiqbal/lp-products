<?php namespace Rono\Banners\Models;

use Model;

/**
 * Model
 */
class Vehicles extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'rono_banners_vehivles_';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
