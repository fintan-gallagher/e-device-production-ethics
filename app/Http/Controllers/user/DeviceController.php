<?php

namespace App\Http\Controllers\User;

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
        $user->authorizeRoles('user');

        // Retrieve all devices from the 'devices' table in the database
        // $devices = Device::all();
        // $devices = Device::paginate(5);
        $devices = Device::with('manufacturer')->get();
        // Return a view called 'devices.index' and pass the retrieved devices to it
        return view('user.devices.index')->with('devices', $devices);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.devices.welcome');
    }


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Find a device in the database by its ID
        $device = Device::find($id);
        // Return a view called 'devices.show' and pass the found device to it
        return view('user.devices.show')->with('device', $device);
    }


}
