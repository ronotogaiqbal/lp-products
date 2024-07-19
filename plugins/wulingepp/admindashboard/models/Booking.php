<?php namespace YourCompany\AdminDashboard\Models;

use Model;

class Booking extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'yourcompany_admindashboard_bookings';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'vehicle',
        'status'
    ];

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'vehicle' => 'required',
        'status' => 'required'
    ];
}