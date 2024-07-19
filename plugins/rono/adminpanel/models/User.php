<?php namespace Rono\AdminPanel\Models;

use Model;

class User extends Model
{
    protected $table = 'rono_users_';

    protected $fillable = ['username', 'password'];

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
