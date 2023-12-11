<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Record;
use App\Models\Label;
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
        // Return a view for creating a new record (likely a form)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $labels = Label::all();
        $records = Record::all();

        return view('admin.artists.create')->with('labels', $labels)->with('records', $records);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Check if a file with the name 'record_cover' is present in the request
        if ($request->hasFile('record_cover')) {
            $image = $request->file('record_cover');

             // Store the uploaded image in the 'public/records' directory with a unique name
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/records', $imageName);
            $record_cover_name = 'storage/records/' . $imageName;
        }

        // Validate the incoming request data to ensure it meets the specified rules
        $request->validate([
            'name' => 'required',
            'social_media' => 'required',
            'email' => 'required',
            'bio' => 'required',
            // 'record_id' => 'required'
        ]);

        // Create a new Record model instance and populate it with the validated data
        $artist = Artist::create([
            'name' => $request->name,
            'social_media' => $request->social_media,
            'email' => $request->email,
            'bio' => $request->bio,
            // 'record_id' => $request->record_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $artist->records()->attach($request->records);
        // Redirect to the 'records.index' route with a success message
        return to_route('admin.artists.index')->with('success', 'Artist created successfully');
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
    public function edit(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing record and pass the record to it
        $labels = Label::all();
        $records = Record::all();
        return view('admin.artists.edit', compact('artist', 'labels', 'records'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a record
        $request->validate([
            'name' => 'required',
            'social_media' => 'required',
            'email' => 'required',
            'bio' => 'required',
        ]);


        // Update the record with the new data
        $artist->update([
            'name' => $request->name,
            'social_media' => $request->social_media,
            'email' => $request->email,
            'bio' => $request->bio,
            // 'label_id' => $request->label_id,
        ]);

        // Redirect to the 'records.show' route with a success message
        return redirect()->route('admin.artists.show', $artist)->with('success', 'Artist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find and delete related records in artist_record table
        $artist->records()->detach();

        // Delete the specified artist record from the database
        $artist->delete();

        // Redirect to the 'admin.artists.index' route with a success message
        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted successfully');
    }

}
