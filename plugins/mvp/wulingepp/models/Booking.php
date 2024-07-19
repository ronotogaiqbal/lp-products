<?php namespace MVP\WulingEPP\Models;

use Model;

class Booking extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rono_vehicles_bookings';

    protected $fillable = [
        'vehicle_types_id',
        'prospect_name',
        'prospect_group',
        'prospect_company',
        'prospect_id_karyawan',
        'prospect_email',
        'prospect_phone',
        'prospect_domisili',
        'test_drive',
        'tc_checked'
    ];

    public $rules = [
        'vehicle_types_id' => 'required|exists:rono_vehicles_type,id',
        'prospect_name' => 'required',
        'prospect_email' => 'required|email',
        'prospect_phone' => 'required',
        'test_drive' => 'boolean',
        'tc_checked' => 'boolean'
    ];

    public function vehicleType()
    {
        return $this->belongsTo('MVP\WulingEPP\Models\VehicleType', 'vehicle_types_id');
    }
}