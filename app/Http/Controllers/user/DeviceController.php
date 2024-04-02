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
        return view('user.devices.index')->with('devices', $devices);

    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.devices.welcome');
    }


    public function show(Device $device)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        if ( !Auth::id()) {
            return abort(403);
        }

        // Find a device in the database by its ID
        $repairguides = $device->repairguides;
        // Return a view called 'devices.show' and pass the found device to it
        return view('user.devices.show', compact('device', 'repairguides'));
    }


}
