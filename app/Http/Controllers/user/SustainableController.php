<?php

namespace App\Http\Controllers\User;

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
        $user->authorizeRoles('user');

        // Retrieve all sustainables from the 'sustainables' table in the database
        // $sustainables = Sustainable::all();
        // $sustainables = Sustainable::paginate(5);
        $sustainables = Sustainable::with('manufacturer')->get();

        // Return a view called 'sustainables.index' and pass the retrieved sustainables to it
        return view('user.sustainables.index')->with('sustainables', $sustainables);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.sustainables.welcome');
    }


    public function show($id)
{
    $user = Auth::user();
    $user->authorizeRoles('user');

    // Find a sustainable in the database by its ID
    $sustainable = Sustainable::find($id);

    // Get the ethics_score of the manufacturer associated with the current sustainable
    $ethics_score = $sustainable->manufacturer->ethics_score;

    // Get three manufacturers with a higher ethics_score
    $manufacturers = Manufacturer::where('ethics_score', '>', $ethics_score)
        ->inRandomOrder()
        ->take(3)
        ->get();

    if ($sustainable) {
        return view('user.sustainables.show', ['sustainable' => $sustainable, 'manufacturers' => $manufacturers]);
    } else {
        return redirect()->route('user.sustainables.index')->with('error', 'No sustainable found with the given ID');
    }

    // Return a view called 'sustainables.show' and pass the found sustainable to it
    return view('user.sustainables.show')->with('sustainable', $sustainable);
}


}
