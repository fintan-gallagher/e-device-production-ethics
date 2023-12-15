<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Record;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecordController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all records from the 'records' table in the database
        // $records = Record::all();
        // $records = Record::paginate(5);
        $records = Record::with('label')->get();
        $records = Record::with('artists')->get();
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('admin.records.index')->with('records', $records);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.records.welcome');
    }

    public function create()
    {
        // Return a view for creating a new record (likely a form)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $labels = Label::all();
        $artists = Artist::all();

        return view('admin.records.create')->with('labels', $labels)->with('artists', $artists);
    }

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
        'title' => 'required',
        'artist' => 'required',
        'genre' => 'required',
        'isbn' => 'required',
        'release_year' => 'required|date|before:2100-01-01',
        'description' => 'required|max:500',
        'record_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'label_id' => 'required',
        'artists' => ['required', 'exists:artists,id']
    ]);

    // Create a new Record model instance and populate it with the validated data
    $record = Record::create([
        'title' => $request->title,
        'artist' => $request->artist,
        'genre' => $request->genre,
        'isbn' => $request->isbn,
        'release_year' => $request->release_year,
        'description' => $request->description,
        'record_cover' => $record_cover_name,
        'label_id' => $request->label_id,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Associate the record with artists based on the many-to-many relationship
    $record->artists()->attach($request->artists);

    // Redirect to the 'records.index' route with a success message
    return redirect()->route('admin.records.index')->with('success', 'Record created successfully');
}


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find a record in the database by its ID
        $record = Record::find($id);
        // Return a view called 'records.show' and pass the found record to it
        return view('admin.records.show')->with('record', $record);
    }

    public function edit(Record $record)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Return a view for editing an existing record and pass the record to it
        $labels = Label::all();
        $artists = Artist::all();
        return view('admin.records.edit', compact('record', 'labels', 'artists'));
    }

    public function update(Request $request, Record $record)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validate the incoming request data for updating a record
        $request->validate([
            'title' => 'required',
            // 'artist' => 'required',
            'genre' => 'required',
            'isbn' => 'required',
            'release_year' => 'required|date|before:2100-12-31',
            'description' => 'required|max:500',
            'record_cover' => 'nullable|image'
        ]);

        // Initialize the 'record_cover_name' variable with the current record's image path
        $record_cover_name = $record->record_cover;

        // If a new 'record_cover' file is provided in the request, update the image
        if ($request->hasFile('record_cover')) {
            $image = $request->file('record_cover');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/records', $imageName);
            $record_cover_name = 'storage/records/' . $imageName;
        }

        // Update the record with the new data
        $record->update([
            'title' => $request->title,
            // 'artist' => $request->artist,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'record_cover' => $record_cover_name,
            'label_id' => $request->label_id,
        ]);

        $record->artists()->attach($request->artists);

        // Redirect to the 'records.show' route with a success message
        return redirect()->route('admin.records.show', $record)->with('success', 'Record updated successfully');
    }

    public function destroy(Record $record)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Find and delete related records in record_record table
        $record->artists()->detach();

        // Delete the specified record record from the database
        $record->delete();

        // Redirect to the 'admin.records.index' route with a success message
        return redirect()->route('admin.records.index')->with('success', 'Record deleted successfully');
    }
}
