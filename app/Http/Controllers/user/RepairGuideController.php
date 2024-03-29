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




    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a sustainable in the database by its ID
        $repairguide = RepairGuide::find($id);
        // Return a view called 'sustainables.show' and pass the found sustainable to it
        return view('admin.repairguides.show')->with('repairguide', $repairguide);
    }


}
