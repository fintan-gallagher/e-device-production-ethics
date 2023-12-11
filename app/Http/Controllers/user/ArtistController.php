<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Retrieve all records from the 'records' table in the database
        $artists = Artist::all();
        // $records = Record::paginate(5);
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('user.artists.index')->with('artists', $artists);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.artists.welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        if ( !Auth::id()) {
            return abort(403);
        }

        // Find a record in the database by its ID
        $records = $artist->records;

        // Return a view called 'records.show' and pass the found record to it
        return view('user.artists.show', compact('artist', 'records'));
    }
}
