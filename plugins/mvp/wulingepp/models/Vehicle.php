<?php namespace MVP\WulingEPP\Models;

use Model;

class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rono_vehicles_';

    protected $fillable = [
        'name',
        'order_view'
    ];

    public $rules = [
        'name' => 'required',
        'order_view' => 'required|integer'
    ];

    public $hasMany = [
        'types' => 'MVP\WulingEPP\Models\VehicleType'
    ];
}