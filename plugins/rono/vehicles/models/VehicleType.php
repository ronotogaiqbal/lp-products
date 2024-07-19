<?php namespace Rono\Vehicles\Models;
use Model;
class VehicleType extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rono_vehicles_type';

    public $rules = [
    ];
    public $belongsTo=[
        'vehicles' => [Vehicles::class, 'key' => 'vehicles_id']
    ];
}
