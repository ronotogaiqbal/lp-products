<?php

use MVP\WulingEPP\Controllers\Dashboard;
use MVP\WulingEPP\Controllers\Banners;
use MVP\WulingEPP\Controllers\Bookings;
use MVP\WulingEPP\Controllers\Vehicles;

Route::group(['prefix' => 'admin/wulingepp'], function() {
    Route::get('/', [Dashboard::class, 'index']);
    Route::resource('banners', Banners::class);
    Route::resource('bookings', Bookings::class);
    Route::resource('vehicles', Vehicles::class);
});