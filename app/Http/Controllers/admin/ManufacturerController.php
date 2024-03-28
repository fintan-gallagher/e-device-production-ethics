<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManufacturerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all devices from the 'devices' table in the database
        $manufacturers = Manufacturer::all();
        // $devices = Device::paginate(5);
        // Return a view called 'devices.index' and pass the retrieved devices to it
        return view('admin.manufacturers.index')->with('manufacturers', $manufacturers);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.manufacturers.welcome');
    }

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Fetch all devices in the database
        $allDevices = Device::all();

        // Return a view for creating a new manufacturer and pass all devices to it
        return view('admin.manufacturers.create', compact('allDevices'));
    }

    public function store(Request $request)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Validate the form data...
    $request->validate([
        'name' => 'required',
        'address' => 'required',
        'email' => 'required',
    ]);

    // Create a new manufacturer
    $manufacturer = Manufacturer::create([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'email' => $request->input('email'),
    ]);

    // Get the selected devices from the form
    $selectedDevices = $request->input('devices', []);

    // Associate each selected device with the new manufacturer
    foreach ($selectedDevices as $deviceId) {
        $device = Device::find($deviceId);

        if ($device) {
            // Associate the device with the manufacturer
            $manufacturer->devices()->save($device);
        }
    }

    // Redirect or perform other actions...

    return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer created successfully.');
}

    public function show(Manufacturer $manufacturer)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if ( !Auth::id()) {
            return abort(403);
        }

        // Find a device in the database by its ID
        $devices = $manufacturer->devices;
        // Return a view called 'devices.show' and pass the found device to it
        return view('admin.manufacturers.show', compact('manufacturer', 'devices'));
    }

    // public function edit(Manufacturer $manufacturer)
    // {
    //     $user = Auth::user();
    //     $user->authorizeRoles('admin');

    //     // Return a view for editing an existing device and pass the device to it
    //     $manufacturers = Manufacturer::all();
    //     return view('admin.manufacturers.edit', compact('manufacturers'));
    // }

   // YourController.php

public function edit(Manufacturer $manufacturer)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    $allDevices = Device::all();
    // Eager load the related devices
    $manufacturerWithDevices = $manufacturer->load('devices');

    // Return a view for editing an existing device and pass the specific device to it
    return view('admin.manufacturers.edit', compact('manufacturerWithDevices', 'allDevices'));
}



public function update(Request $request, Manufacturer $manufacturer)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Validate the form data...
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        // ... other validation rules ...
    ]);

    // Update the manufacturer
    $manufacturer->update([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'email' => $request->input('email'),
        // ... other fields ...
    ]);

    // Update the associated devices
    foreach ($request->input('devices', []) as $deviceId) {
        // Assuming you have a Device model
        $device = Device::find($deviceId);

        // Update the device with the new manufacturer_id
        $device->update(['manufacturer_id' => $manufacturer->id]);
    }

    // Redirect back to the index page with a success message
    return redirect()->route('admin.manufacturers.index', $manufacturer)
        ->with('success', 'Manufacturer updated successfully.');
}




public function destroy(Manufacturer $manufacturer)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Get a default manufacturer ID that doesn't correspond to any existing manufacturer
    $defaultManufacturerId = Manufacturer::doesntExist() ? null : Manufacturer::first()->id;

    // Update associated devices to have a default manufacturer ID
    $manufacturer->devices->each(function ($device) use ($defaultManufacturerId) {
        $device->update(['manufacturer_id' => $defaultManufacturerId]);
    });

    // Delete the specified manufacturer from the database
    $manufacturer->delete();

    // Redirect to the 'manufacturers.index' route with a success message
    return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer deleted successfully');
}

}
