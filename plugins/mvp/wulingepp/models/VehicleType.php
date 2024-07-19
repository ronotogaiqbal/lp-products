<?php namespace MVP\WulingEPP\Models;

use Model;

class VehicleType extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rono_vehicles_type';

    protected $fillable = [
        'vehicles_id',
        'name_type',
        'fuel',
        'transmission',
        'image_path',
        'link_brochure',
        'price',
        'discount',
        'link_more'
    ];

    public $rules = [
        'vehicles_id' => 'required|exists:rono_vehicles_,id',
        'name_type' => 'required',
        'fuel' => 'required',
        'transmission' => 'required',
        'image_path' => 'required',
        'link_brochure' => 'required|url',
        'price' => 'required|integer',
        'discount' => 'integer',
        'link_more' => 'required|url'
    ];

    public function vehicle()
    {
        return $this->belongsTo('MVP\WulingEPP\Models\Vehicle', 'vehicles_id');
    }
}