<?php namespace Rono\AdminPanel\Models;

use Model;

class VehicleType extends Model
{
    // Define the table associated with the model
    protected $table = 'rono_vehicles_type';

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['vehicles_id', 'type'];

    // Define the inverse relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id');
    }
}
