<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Part;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all sustainables from the 'sustainables' table in the database
        // $sustainables = Sustainable::all();
        // $sustainables = Sustainable::paginate(5);
        $parts = Part::with('device')->get();

        // Return a view called 'sustainables.index' and pass the retrieved sustainables to it
        return view('admin.parts.index')->with('parts', $parts);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.parts.welcome');
    }

    public function create()
    {
        // Return a view for creating a new sustainable (likely a form)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $devices = Device::all();


        return view('admin.parts.create')->with('devices', $devices);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data to ensure it meets the specified rules
        $request->validate([
            'heading' => 'required',
            'oem' => 'required|in:yes,no',
            'part_url' => 'required|url',
            'admin_rec' => 'required|in:yes,no',
            'device_id' => 'required',
        ]);

        // Create a new Sustainable model instance and populate it with the validated data
        $sustainable = Part::create([
            'heading' => $request->heading,
            'oem' => $request->oem,
            'part_url' => $request->part_url,
            'admin_rec' => $request->admin_rec,
            'device_id' => $request->device_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);



        // Redirect to the 'sustainables.index' route with a success message
        return redirect()->route('admin.parts.index')->with('success', 'Repair Guide created successfully');
    }


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a sustainable in the database by its ID
        $part = Part::find($id);
        // Return a view called 'sustainables.show' and pass the found sustainable to it
        return view('admin.parts.show')->with('part', $part);
    }

    public function edit(Part $part)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing part and pass the part to it
        $devices = Device::all();

        return view('admin.parts.edit', compact('part', 'devices'));
    }

    public function update(Request $request, Part $part)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a part
        $request->validate([
            'heading' => 'required',
            'oem' => 'required|in:yes,no',
            'part_url' => 'required|url',
            'admin_rec' => 'required|in:yes,no'
        ]);


        // Update the part with the new data
        $part->update([
            'heading' => $request->heading,
            'oem' => $request->oem,
            'part_url' => $request->part_url,
            'admin_rec' => $request->admin_rec,
            'device_id' => $request->device_id,
        ]);



        // Redirect to the 'parts.show' route with a success message
        return redirect()->route('admin.parts.show', $part)->with('success', 'Repair Guide updated successfully');
    }

    public function destroy(Part $part)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find and delete related parts in part_part table
        // $part->artists()->detach();

        // Delete the specified part part from the database
        $part->delete();

        // Redirect to the 'admin.parts.index' route with a success message
        return redirect()->route('admin.parts.index')->with('success', 'Part deleted successfully');
    }
}
