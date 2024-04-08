<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\RepairGuide;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RepairGuideController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all sustainables from the 'sustainables' table in the database
        // $sustainables = Sustainable::all();
        // $sustainables = Sustainable::paginate(5);
        $repairguides = RepairGuide::with('device')->get();

        // Return a view called 'sustainables.index' and pass the retrieved sustainables to it
        return view('admin.repairguides.index')->with('repairguides', $repairguides);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.repairguides.welcome');
    }

    public function create()
    {
        // Return a view for creating a new sustainable (likely a form)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $devices = Device::all();


        return view('admin.repairguides.create')->with('devices', $devices);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data to ensure it meets the specified rules
        $request->validate([
            'heading' => 'required',
            'guide' => 'required|url',
            'device_id' => 'required',
        ]);

        // Create a new Sustainable model instance and populate it with the validated data
        $sustainable = RepairGuide::create([
            'heading' => $request->heading,
            'guide' => $request->guide,
            'device_id' => $request->device_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);



        // Redirect to the 'sustainables.index' route with a success message
        return redirect()->route('admin.repairguides.index')->with('success', 'Repair Guide created successfully');
    }


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a sustainable in the database by its ID
        $repairguide = RepairGuide::find($id);
        // Return a view called 'sustainables.show' and pass the found sustainable to it
        return view('admin.repairguides.show')->with('repairguide', $repairguide);
    }

    public function edit(RepairGuide $repairguide)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing repairguide and pass the repairguide to it
        $devices = Device::all();

        return view('admin.repairguides.edit', compact('repairguide', 'devices'));
    }

    public function update(Request $request, RepairGuide $repairguide)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a repairguide
        $request->validate([
            'heading' => 'required',
            'guide' => 'required|url',
        ]);


        // Update the repairguide with the new data
        $repairguide->update([
            'heading' => $request->heading,
            'guide' => $request->guide,
            'device_id' => $request->device_id,
        ]);



        // Redirect to the 'repairguides.show' route with a success message
        return redirect()->route('admin.repairguides.show', $repairguide)->with('success', 'Repair Guide updated successfully');
    }

    public function destroy(RepairGuide $repairguide)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find and delete related repairguides in repairguide_repairguide table
        // $repairguide->artists()->detach();

        // Delete the specified repairguide repairguide from the database
        $repairguide->delete();

        // Redirect to the 'admin.repairguides.index' route with a success message
        return redirect()->route('admin.repairguides.index')->with('success', 'Repair Guide deleted successfully');
    }
}
