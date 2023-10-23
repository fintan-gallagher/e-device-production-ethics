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
      $request->validate([
        'title' => 'required'
      ]);

      Record::create([
        'title' => $request->title,
        'artist' => "Test Artist",
        'genre' => "Test Genre",
        'isbn' => "ISBN123123",
        'year' => "Test Year",
        'description' => "Test Description",
        'record_cover' => "public\image\Tess_the_TickTock_Dog.jpg",
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
