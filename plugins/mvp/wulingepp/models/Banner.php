<?php namespace MVP\WulingEPP\Models;

use Model;

class Banner extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'rono_banners_';

    protected $fillable = [
        'link',
        'image_path',
        'order',
        'is_active'
    ];

    public $rules = [
        'link' => 'required|url',
        'image_path' => 'required',
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];
}