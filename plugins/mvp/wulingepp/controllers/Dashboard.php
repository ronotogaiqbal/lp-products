<?php namespace MVP\WulingEPP\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use MVP\WulingEPP\Models\Banner;
use MVP\WulingEPP\Models\Booking;
use MVP\WulingEPP\Models\Vehicle;

class Dashboard extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $bookings = Booking::all();
        $vehicles = Vehicle::all();

        return View::make('mvp.wulingepp::dashboard.index', [
            'banners' => $banners,
            'bookings' => $bookings,
            'vehicles' => $vehicles,
        ]);
    }
}