<?php namespace MVP\WulingEPP\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use MVP\WulingEPP\Models\Vehicle;
use Illuminate\Http\Request;

class Vehicles extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('types')->get();
        return View::make('mvp.wulingepp::vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        return View::make('mvp.wulingepp::vehicles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'order_view' => 'required|integer',
            'types' => 'required|array'
        ]);

        $vehicle = Vehicle::create($validatedData);
        
        foreach ($request->types as $type) {
            $vehicle->types()->create($type);
        }

        return redirect()->route('mvp.wulingepp.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::with('types')->findOrFail($id);
        return View::make('mvp.wulingepp::vehicles.edit', ['vehicle' => $vehicle]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'order_view' => 'required|integer',
            'types' => 'required|array'
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($validatedData);
        
        $vehicle->types()->delete();
        foreach ($request->types as $type) {
            $vehicle->types()->create($type);
        }

        return redirect()->route('mvp.wulingepp.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->types()->delete();
        $vehicle->delete();

        return redirect()->route('mvp.wulingepp.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}