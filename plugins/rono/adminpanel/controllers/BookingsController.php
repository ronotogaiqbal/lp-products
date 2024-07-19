<?php namespace Rono\AdminPanel\Controllers;

use Backend\Classes\Controller;
use Rono\AdminPanel\Models\Booking;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class BookingsController extends Controller
{
    public function index()
    {
        $statusFilter = Request::query('status');
        $query = Booking::with('vehicleType.vehicle');

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        $bookings = $query->get();
        return view('rono.adminpanel::bookings.index', [
            'bookings' => $bookings,
            'statusFilter' => $statusFilter
        ]);
    }

    public function updateStatus($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->status = Request::input('status');
            $booking->save();
        }
        return Redirect::back();
    }

    public function export()
    {
        $bookings = Booking::with('vehicleType.vehicle')->get();
        $filename = "bookings_" . date('YmdHis') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['ID', 'Registered At', 'Vehicle Name', 'Prospect Name', 'Prospect Group', 'Prospect Company', 'Prospect ID Karyawan', 'Prospect Email', 'Prospect Phone', 'Prospect Domisili', 'Test Drive', 'TC Checked', 'Status']);

        foreach ($bookings as $booking) {
            $vehicleName = $booking->vehicleType->vehicle->name . ' ' . $booking->vehicleType->name_type;
            fputcsv($handle, [
                $booking->id, $booking->prospect_name, $booking->updated_at->format('d-M'), $booking->status, $vehicleName, 
				$booking->prospect_group, $booking->prospect_company,
                $booking->prospect_id_karyawan, $booking->prospect_email, $booking->prospect_phone,
                $booking->prospect_domisili, $booking->test_drive ? 'Yes' : 'No', $booking->tc_checked ? 'Yes' : 'No'
            ]);
        }

        fclose($handle);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
}
