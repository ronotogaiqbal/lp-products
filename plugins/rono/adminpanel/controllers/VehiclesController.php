<?php namespace Rono\AdminPanel\Controllers;

use Backend\Classes\Controller;
//use BackendMenu;
use Rono\AdminPanel\Models\Vehicle;
use Rono\AdminPanel\Models\VehicleType;
use Input;
use Redirect;
use Flash;

class VehiclesController extends Controller
{
    public $implement = ['Backend.Behaviors.FormController', 'Backend.Behaviors.ListController'];

    // Define the configuration file paths
    public $formConfig = '$/rono/adminpanel/controllers/vehicles/config_form.yaml';
    public $listConfig = '$/rono/adminpanel/controllers/vehicles/config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        //BackendMenu::setContext('Rono.AdminPanel', 'main-menu-item', 'side-menu-item');
    }

    // List all vehicles
    public function index()
    {
        $this->pageTitle = 'Manage Vehicles';
        $this->vars['vehicles'] = Vehicle::with('vehicleTypes')->get();
        return $this->makeView('index');
    }

    // Show the form to create a new vehicle
    public function create()
    {
        $this->pageTitle = 'Add New Vehicle';
        return $this->makeView('create');
    }

    // Store a new vehicle in the database
    public function store()
    {
        $vehicleData = Input::only(['name', 'order_view']);
        $vehicle = Vehicle::create($vehicleData);

        // Handle vehicle types
        $vehicleTypes = Input::get('vehicle_types', []);
        foreach ($vehicleTypes as $type) {
            VehicleType::create([
                'vehicles_id' => $vehicle->id,
                'type' => $type
            ]);
        }

        Flash::success('Vehicle created successfully!');
        return Redirect::to('backend/rono/adminpanel/vehicles');
    }

    // Show the form to edit an existing vehicle
    public function edit($id)
    {
        $this->pageTitle = 'Edit Vehicle';
        $this->vars['vehicle'] = Vehicle::with('vehicleTypes')->find($id);
        return $this->makeView('edit');
    }

    // Update an existing vehicle in the database
    public function update($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicleData = Input::only(['name', 'order_view']);
        $vehicle->update($vehicleData);

        // Handle vehicle types
        $vehicle->vehicleTypes()->delete(); // Delete existing types
        $vehicleTypes = Input::get('vehicle_types', []);
        foreach ($vehicleTypes as $type) {
            VehicleType::create([
                'vehicles_id' => $vehicle->id,
                'type' => $type
            ]);
        }

        Flash::success('Vehicle updated successfully!');
        return Redirect::to('backend/rono/adminpanel/vehicles');
    }

    // Delete a vehicle from the database
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->vehicleTypes()->delete();
        $vehicle->delete();

        Flash::success('Vehicle deleted successfully!');
        return Redirect::to('backend/rono/adminpanel/vehicles');
    }
}
