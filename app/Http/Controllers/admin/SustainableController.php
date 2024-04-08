<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Sustainable;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SustainableController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all sustainables from the 'sustainables' table in the database
        // $sustainables = Sustainable::all();
        // $sustainables = Sustainable::paginate(5);
        $sustainables = Sustainable::with('manufacturer')->get();

        // Return a view called 'sustainables.index' and pass the retrieved sustainables to it
        return view('admin.sustainables.index')->with('sustainables', $sustainables);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.sustainables.welcome');
    }

    public function create(Request $request)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    $manufacturers = Manufacturer::all();
    $manufacturer_id = $request->query('manufacturer');

    return view('admin.sustainables.create', compact('manufacturers', 'manufacturer_id'));
}

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data to ensure it meets the specified rules
        $request->validate([
            'heading' => 'required',
            'comments' => 'required',
            'manufacturer_id' => 'required',
        ]);

        // Create a new Sustainable model instance and populate it with the validated data
        $sustainable = Sustainable::create([
            'heading' => $request->heading,
            'comments' => $request->comments,
            'manufacturer_id' => $request->manufacturer_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);



        // Redirect to the 'sustainables.index' route with a success message
        return redirect()->route('admin.sustainables.show', $sustainable)->with('success', 'Sustainable created successfully');
    }


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a sustainable in the database by its ID
        $sustainable = Sustainable::find($id);
        $manufacturers = Manufacturer::inRandomOrder()->take(3)->get();

        if ($sustainable) {
            return view('admin.sustainables.show', ['sustainable' => $sustainable, 'manufacturers' => $manufacturers]);
        } else {
            return redirect()->route('admin.sustainables.index')->with('error', 'No sustainable found with the given ID');
        }

        // Return a view called 'sustainables.show' and pass the found sustainable to it
        return view('admin.sustainables.show')->with('sustainable', $sustainable);
    }

    public function edit(Sustainable $sustainable)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing sustainable and pass the sustainable to it
        $manufacturers = Manufacturer::all();

        return view('admin.sustainables.edit', compact('sustainable', 'manufacturers'));
    }

    public function update(Request $request, Sustainable $sustainable)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a sustainable
        $request->validate([
            'heading' => 'required',
            'comments' => 'required'
        ]);


        // Update the sustainable with the new data
        $sustainable->update([
            'heading' => $request->heading,
            'comments' => $request->comments,
            // 'manufacturer_id' => $request->manufacturer_id,
        ]);



        // Redirect to the 'sustainables.show' route with a success message
        return redirect()->route('admin.sustainables.show', $sustainable)->with('success', 'Sustainable updated successfully');
    }

    public function destroy(Sustainable $sustainable)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Get the manufacturer associated with the sustainable
    $manufacturer = $sustainable->manufacturer;

    // Delete the specified sustainable from the database
    $sustainable->delete();

    // Redirect to the 'admin.manufacturers.show' route with a success message
    return redirect()->route('admin.manufacturers.show', $manufacturer)->with('success', 'Sustainable deleted successfully');
}
}
