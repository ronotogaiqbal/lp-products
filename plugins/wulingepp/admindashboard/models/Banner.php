<?php namespace WulingEPP\AdminDashboard\Models;

use Model;

class Banner extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'wulingepp_admindashboard_banners';

    protected $fillable = [
        'image',
        'link',
        'is_active'
    ];

    public $rules = [
        'image' => 'required',
        'link' => 'required|url',
        'is_active' => 'boolean'
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];
}