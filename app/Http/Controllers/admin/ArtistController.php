<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Auth;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all records from the 'records' table in the database
        $artists = Artist::all();
        // $records = Record::paginate(5);
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('admin.artists.index')->with('artists', $artists);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Retrieve records for the artist
        $records = $artist->records;
        return view('admin.artists.show', compact('artist', 'records'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
