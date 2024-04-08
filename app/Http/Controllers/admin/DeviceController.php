<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Device;
use App\Models\RepairGuide;
use App\Models\Part;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DeviceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve the search query from the request
        $search = request('search');
        $orderBy = request('order_by'); // Retrieve the order_by parameter

        // Retrieve all devices from the 'devices' table in the database that match the search query
        $devices = Device::with('manufacturer')
            ->when($search, function ($query, $search) {
                $query->where('model', 'like', "%{$search}%")
                    ->orWhereHas('manufacturer', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            // Orders devices according to price, recyclability or repairability
            ->when($orderBy, function ($query, $orderBy) {
                if ($orderBy === 'price') {
                    $query->orderBy('price', 'desc');
                } else {
                    $query->orderBy($orderBy, 'desc');
                }
            })
            ->paginate(10)
            ->appends(request()->query());

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
            'model' => 'required',
            'repairability' => 'required|numeric|between:0,100',
            'parts_availability' => 'required|in:Yes,No',
            'recycled' => 'required|numeric|between:0,100',
            'release_year' => 'required|date|before:2100-01-01',
            'price' => 'required|numeric|between:0,4500',
            'device_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'manufacturer_id' => 'required',
            'new_repair_guides.*' => 'required|url',
        ]);

        // Create a new Device model instance and populate it with the validated data
        $device = Device::create([
            'model' => $request->model,
            'repairability' => $request->repairability,
            'parts_availability' => $request->parts_availability,
            'recycled' => $request->recycled,
            'release_year' => $request->release_year,
            'price' => $request->price,
            'device_cover' => $device_cover_name,
            'manufacturer_id' => $request->manufacturer_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create new repair guides
        if ($request->has('new_repair_guides')) {
            foreach ($request->input('new_repair_guides') as $index => $guide) {
                $heading = $request->input('new_repair_guide_headings')[$index];
                $device->repairGuides()->create(['guide' => $guide, 'heading' => $heading]);
            }
        }

        if ($request->has('new_parts_urls')) {
            foreach ($request->input('new_parts_urls') as $index => $url) {
                $heading = $request->input('new_parts_headings')[$index];
                $oem = $request->input('new_parts_oems')[$index];
                $adminRec = $request->input('new_parts_admin_recs')[$index];
                $device->parts()->create(['heading' => $heading, 'part_url' => $url, 'oem' => $oem, 'admin_rec' => $adminRec]);
            }
        }


        // Redirect to the 'devices.index' route with a success message
        return redirect()->route('admin.devices.index')->with('success', 'Device created successfully');
    }


    public function show(Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if (!Auth::id()) {
            return abort(403);
        }

        $recommendedDevices = Device::where('repairability', '>', $device->repairability)
        ->where('id', '!=', $device->id)
        ->take(3)
        ->get();
        $recycledDevices = Device::where('recycled', '>', $device->recycled)->take(3)->get();

        // Find a device in the database by its ID
        $repairguides = $device->repairguides;
        // Return a view called 'devices.show' and pass the found device to it
        return view('admin.devices.show', compact('device', 'repairguides', 'recommendedDevices', 'recycledDevices'));
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
            'model' => 'required',
            'repairability' => 'required|numeric|between:0,100',
            // 'parts_availability' => 'required|in:Yes,No',
            'recycled' => 'required|numeric|between:0,100',
            'release_year' => 'required|date|before:2100-01-01',
            'price' => 'required|numeric|between:0,4500',
            'device_cover' => 'nullable|image',
            'new_repair_guides.*' => 'required|url',
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
            'model' => $request->model,
            'repairability' => $request->repairability,
            // 'parts_availability' => $request->parts_availability,
            'recycled' => $request->recycled,
            'release_year' => $request->release_year,
            'price' => $request->price,
            'device_cover' => $device_cover_name,
            'manufacturer_id' => $request->manufacturer_id,
        ]);

        // Create new repair guides
        if ($request->has('new_repair_guides')) {
            foreach ($request->input('new_repair_guides') as $index => $guide) {
                $heading = $request->input('new_repair_guide_headings')[$index];
                $device->repairGuides()->create(['guide' => $guide, 'heading' => $heading]);
            }
        }

        // Remove repair guides
        if ($request->has('remove_repair_guides')) {
            foreach ($request->input('remove_repair_guides') as $guideId) {
                RepairGuide::find($guideId)->delete();
            }
        }

        // Create new Part
        if ($request->has('new_parts_urls')) {
            foreach ($request->input('new_parts_urls') as $index => $url) {
                $heading = $request->input('new_parts_headings')[$index];
                $oem = $request->input('new_parts_oems')[$index];
                $adminRec = $request->input('new_parts_admin_recs')[$index];
                $device->parts()->create(['heading' => $heading, 'part_url' => $url, 'oem' => $oem, 'admin_rec' => $adminRec]);
            }
        }

        // Remove parts
        if ($request->has('remove_parts')) {
            foreach ($request->input('remove_parts') as $partId) {
                Part::find($partId)->delete();
            }

            // Get a fresh instance of the device model
            $device = $device->fresh();
        }

        // Update part_availability
        $hasParts = $device->parts()->exists();
        $device->parts_availability = $hasParts ? 'Yes' : 'No';
        $device->save();

        // Redirect to the 'devices.show' route with a success message
        return redirect()->route('admin.devices.show', $device)->with('success', 'Device updated successfully');
    }

    public function parts(Device $device)
    {
        $parts = $device->parts;

        return view('admin.devices.parts', compact('device', 'parts'));
    }

    public function destroy(Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Delete the repair guides associated with the device
        $device->repairGuides()->delete();

        // Delete the specified device device from the database
        $device->delete();

        // Redirect to the 'admin.devices.index' route with a success message
        return redirect()->route('admin.devices.index')->with('success', 'Device deleted successfully');
    }
}
