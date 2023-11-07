<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        // Retrieve all records from the 'records' table in the database
        $records = Record::all();
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('records.index', compact('records'));
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        return view('home');
    }

    public function create()
    {
        // Return a view for creating a new record (likely a form)
        return view('records.create');
    }

    public function store(Request $request)
    {
        // Check if a file with the name 'record_cover' is present in the request
        if ($request->hasFile('record_cover')) {
            $image = $request->file('record_cover');
            $imageName = time() . '.' . $image->extension();

            // Store the uploaded image in the 'public/records' directory with a unique name
            $image->storeAs('public/records', $imageName);
            $record_cover_name = 'storage/records/' . $imageName;
        }

        // Validate the incoming request data to ensure it meets the specified rules
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'isbn' => 'required',
            'release_year' => 'required',
            'description' => 'required|max:500',
            'record_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Record model instance and populate it with the validated data
        Record::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'record_cover' => $record_cover_name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Redirect to the 'records.index' route with a success message
        return to_route('records.index')->with('success', 'Record created successfully');
    }

    public function show($id)
    {
        // Find a record in the database by its ID
        $record = Record::find($id);
        // Return a view called 'records.show' and pass the found record to it
        return view('records.show')->with('record', $record);
    }

    public function edit(Record $record)
    {
        // Return a view for editing an existing record and pass the record to it
        return view('records.edit')->with('record', $record);
    }

    public function update(Request $request, Record $record)
    {
        // Validate the incoming request data for updating a record
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'genre' => 'required',
            'isbn' => 'required',
            'release_year' => 'required',
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
            'artist' => $request->artist,
            'genre' => $request->genre,
            'isbn' => $request->isbn,
            'release_year' => $request->release_year,
            'description' => $request->description,
            'record_cover' => $record_cover_name
        ]);

        // Redirect to the 'records.show' route with a success message
        return redirect()->route('records.show', $record)->with('success', 'Record updated successfully');
    }

    public function destroy(Record $record)
    {
        // Delete the specified record from the database
        $record->delete();

        // Redirect to the 'records.index' route with a success message
        return to_route('records.index')->with('success', 'Record deleted successfully');
    }
}
