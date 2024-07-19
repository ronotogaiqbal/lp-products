<?php namespace Rono\AdminPanel\Models;

use Model;

class Booking extends Model
{
    protected $table = 'rono_vehicles_bookings';

    protected $fillable = [
        'vehicle_types_id', 'prospect_name', 'prospect_group', 'prospect_company',
        'prospect_id_karyawan', 'prospect_email', 'prospect_phone', 'prospect_domisili',
        'test_drive', 'tc_checked', 'status'
    ];

    public $timestamps = true;

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_types_id');
    }
}
