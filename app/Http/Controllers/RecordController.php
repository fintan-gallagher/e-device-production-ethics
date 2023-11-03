<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::all();
        return view('records.index', compact('records'));
    }

    public function home()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      if($request->hasFile('record_cover')) {
        $image = $request->file('record_cover');
        $imageName = time() . '.' . $image->extension();

        $image->storeAs('public/records', $imageName);
        $record_cover_name = 'storage/records/' . $imageName;
      }

      $request->validate([
        'title' => 'required',
        'artist' => 'required',
        'genre' => 'required',
        'isbn' => 'required',
        'release_year' => 'required',
        'description' => 'required|max:500',

        'record_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

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
      return to_route('records.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $record = Record::find($id);
        return view('records.show')->with('record', $record);
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
