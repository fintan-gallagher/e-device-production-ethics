<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Retrieve all devices from the 'devices' table in the database
        $manufacturers = Manufacturer::all();
        // $devices = Device::paginate(5);
        // Return a view called 'devices.index' and pass the retrieved devices to it
        return view('user.manufacturers.index')->with('manufacturers', $manufacturers);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.manufacturers.welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manufacturer $manufacturer)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        if ( !Auth::id()) {
            return abort(403);
        }

        // Find a device in the database by its ID
        $devices = $manufacturer->devices;
        // Return a view called 'devices.show' and pass the found device to it
        return view('user.manufacturers.show', compact('manufacturer', 'devices'));
    }
}
