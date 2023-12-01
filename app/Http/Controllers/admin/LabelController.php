<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LabelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Retrieve all records from the 'records' table in the database
        $labels = Label::all();
        // $records = Record::paginate(5);
        // Return a view called 'records.index' and pass the retrieved records to it
        return view('admin.labels.index')->with('labels', $labels);
    }

    public function home()
    {
        // Return a view called 'home' (This might be your application's homepage)
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.labels.welcome');
    }

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Fetch all records in the database
        $allRecords = Record::all();

        // Return a view for creating a new label and pass all records to it
        return view('admin.labels.create', compact('allRecords'));
    }

    public function store(Request $request)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Validate the form data...
    $request->validate([
        'name' => 'required',
        'address' => 'required',
        'email' => 'required',
    ]);

    // Create a new label
    $label = Label::create([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'email' => $request->input('email'),
    ]);

    // Get the selected records from the form
    $selectedRecords = $request->input('records', []);

    // Associate each selected record with the new label
    foreach ($selectedRecords as $recordId) {
        $record = Record::find($recordId);

        if ($record) {
            // Associate the record with the label
            $label->records()->save($record);
        }
    }

    // Redirect or perform other actions...

    return redirect()->route('admin.labels.index')->with('success', 'Label created successfully.');
}

    public function show(Label $label)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if ( !Auth::id()) {
            return abort(403);
        }

        // Find a record in the database by its ID
        $records = $label->records;
        // Return a view called 'records.show' and pass the found record to it
        return view('admin.labels.show', compact('label', 'records'));
    }

    // public function edit(Label $label)
    // {
    //     $user = Auth::user();
    //     $user->authorizeRoles('admin');

    //     // Return a view for editing an existing record and pass the record to it
    //     $labels = Label::all();
    //     return view('admin.labels.edit', compact('labels'));
    // }

   // YourController.php

public function edit(Label $label)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    $allRecords = Record::all();
    // Eager load the related records
    $labelWithRecords = $label->load('records');

    // Return a view for editing an existing record and pass the specific record to it
    return view('admin.labels.edit', compact('labelWithRecords', 'allRecords'));
}



public function update(Request $request, Label $label)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Validate the form data...
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        // ... other validation rules ...
    ]);

    // Update the label
    $label->update([
        'name' => $request->input('name'),
        'address' => $request->input('address'),
        'email' => $request->input('email'),
        // ... other fields ...
    ]);

    // Redirect back to the index page with a success message
    return redirect()->route('admin.labels.index', $label)
        ->with('success', 'Label updated successfully.');
}



public function destroy(Label $label)
{
    $user = Auth::user();
    $user->authorizeRoles('admin');

    // Get a default label ID that doesn't correspond to any existing label
    $defaultLabelId = Label::doesntExist() ? null : Label::first()->id;

    // Update associated records to have a default label ID
    $label->records->each(function ($record) use ($defaultLabelId) {
        $record->update(['label_id' => $defaultLabelId]);
    });

    // Delete the specified label from the database
    $label->delete();

    // Redirect to the 'labels.index' route with a success message
    return redirect()->route('admin.labels.index')->with('success', 'Label deleted successfully');
}

}
