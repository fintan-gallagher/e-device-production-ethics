<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Device;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DeviceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all devices from the 'devices' table in the database
        // $devices = Device::all();
        // $devices = Device::paginate(5);
        $devices = Device::with('manufacturer')->get();

        // Return a view called 'devices.index' and pass the retrieved devices to it
        return view('admin.devices.index')->with('devices', $devices);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.devices.welcome');
    }

    public function create()
    {
        // Return a view for creating a new device (likely a form)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $manufacturers = Manufacturer::all();


        return view('admin.devices.create')->with('manufacturers', $manufacturers);
    }

    public function store(Request $request)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Check if a file with the name 'device_cover' is present in the request
    if ($request->hasFile('device_cover')) {
        $image = $request->file('device_cover');

         // Store the uploaded image in the 'public/devices' directory with a unique name
        $imageName = time() . '.' . $image->extension();
        $image->storeAs('public/devices', $imageName);
        $device_cover_name = 'storage/devices/' . $imageName;
    }

    // Validate the incoming request data to ensure it meets the specified rules
    $request->validate([
        'title' => 'required',
        'artist' => 'required',
        'genre' => 'required',
        'isbn' => 'required',
        'release_year' => 'required|date|before:2100-01-01',
        'description' => 'required|max:500',
        'device_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'manufacturer_id' => 'required',
    ]);

    // Create a new Device model instance and populate it with the validated data
    $device = Device::create([
        'title' => $request->title,
        'artist' => $request->artist,
        'genre' => $request->genre,
        'isbn' => $request->isbn,
        'release_year' => $request->release_year,
        'description' => $request->description,
        'device_cover' => $device_cover_name,
        'manufacturer_id' => $request->manufacturer_id,
        'created_at' => now(),
        'updated_at' => now()
    ]);



    // Redirect to the 'devices.index' route with a success message
    return redirect()->route('admin.devices.index')->with('success', 'Device created successfully');
}


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a device in the database by its ID
        $device = Device::find($id);
        // Return a view called 'devices.show' and pass the found device to it
        return view('admin.devices.show')->with('device', $device);
    }

    public function edit(Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing device and pass the device to it
        $manufacturers = Manufacturer::all();

        return view('admin.devices.edit', compact('device', 'manufacturers'));
    }

    public function update(Request $request, Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a device
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'isbn' => 'required',
            'release_year' => 'required|date|before:2100-12-31',
            'description' => 'required|max:500',
            'device_cover' => 'nullable|image'
        ]);

        // Initialize the 'device_cover_name' variable with the current device's image path
        $device_cover_name = $device->device_cover;

        // If a new 'device_cover' file is provided in the request, update the image
        if ($request->hasFile('device_cover')) {
            $image = $request->file('device_cover');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/devices', $imageName);
            $device_cover_name = 'storage/devices/' . $imageName;
        }

        // Update the device with the new data
        $device->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'device_cover' => $device_cover_name,
            'manufacturer_id' => $request->manufacturer_id,
        ]);

        

        // Redirect to the 'devices.show' route with a success message
        return redirect()->route('admin.devices.show', $device)->with('success', 'Device updated successfully');
    }

    public function destroy(Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find and delete related devices in device_device table
        // $device->artists()->detach();

        // Delete the specified device device from the database
        $device->delete();

        // Redirect to the 'admin.devices.index' route with a success message
        return redirect()->route('admin.devices.index')->with('success', 'Device deleted successfully');
    }
}
