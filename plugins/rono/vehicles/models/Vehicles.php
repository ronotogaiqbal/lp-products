<?php namespace Rono\Vehicles\Models;
use Model;
class Vehicles extends Model
{
    use \October\Rain\Database\Traits\Validation;
    public $table = 'rono_vehicles_';
    public $rules = [
    ];
    public $hasMany=[
        'types'=>VehicleType::class
    ];
}
