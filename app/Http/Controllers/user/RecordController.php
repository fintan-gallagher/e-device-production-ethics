<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Label;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RecordController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Retrieve all records from the 'records' table in the database
        // $records = Record::all();
        // $records = Record::paginate(5);
        $records = Record::with('label')->get();
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('user.records.index')->with('records', $records);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.records.welcome');
    }


    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Find a record in the database by its ID
        $record = Record::find($id);
        // Return a view called 'records.show' and pass the found record to it
        return view('user.records.show')->with('record', $record);
    }


}
