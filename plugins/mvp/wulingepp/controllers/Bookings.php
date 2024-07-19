<?php namespace MVP\WulingEPP\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use MVP\WulingEPP\Models\Booking;
use Illuminate\Http\Request;

class Bookings extends Controller
{
    public function index()
    {
        $bookings = Booking::with('vehicleType')->get();
        return View::make('mvp.wulingepp::bookings.index', ['bookings' => $bookings]);
    }

    public function create()
    {
        return View::make('mvp.wulingepp::bookings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_types_id' => 'required|exists:rono_vehicles_type,id',
            'prospect_name' => 'required',
            'prospect_email' => 'required|email',
            'prospect_phone' => 'required',
            'test_drive' => 'boolean',
            'tc_checked' => 'boolean'
        ]);

        $booking = Booking::create($validatedData);

        return redirect()->route('mvp.wulingepp.bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return View::make('mvp.wulingepp::bookings.edit', ['booking' => $booking]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vehicle_types_id' => 'required|exists:rono_vehicles_type,id',
            'prospect_name' => 'required',
            'prospect_email' => 'required|email',
            'prospect_phone' => 'required',
            'test_drive' => 'boolean',
            'tc_checked' => 'boolean'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($validatedData);

        return redirect()->route('mvp.wulingepp.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('mvp.wulingepp.bookings.index')->with('success', 'Booking deleted successfully.');
    }
}