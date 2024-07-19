<?php namespace Rono\AdminPanel\Models;

use Model;

class Vehicle extends Model
{
    // Define the table associated with the model
    protected $table = 'rono_vehicles_';

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['name', 'order_view'];

    // Define the relationship with the VehicleType model
    public function vehicleTypes()
    {
        return $this->hasMany(VehicleType::class, 'vehicles_id');
    }
}
