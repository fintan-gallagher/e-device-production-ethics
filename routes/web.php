<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\DeviceController;

use App\Http\Controllers\admin\DeviceController as AdminDeviceController;
use App\Http\Controllers\user\DeviceController as UserDeviceController;

use App\Http\Controllers\admin\ManufacturerController as AdminManufacturerController;
use App\Http\Controllers\user\ManufacturerController as UserManufacturerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define a route that maps the root URL '/' to the 'welcome' view
Route::get('/', function () {
    return view('welcome');
});

// Define a resourceful route for managing 'devices' using the 'DeviceController'
// Route::resource('/devices', AdminDeviceController::class);

// Define a route to access the 'dashboard' view, which is protected by the 'auth' and 'verified' middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Define a group of routes protected by the 'auth' middleware
Route::middleware('auth')->group(function () {
    // Route for editing a user's profile, linked to the 'ProfileController@edit' method
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route for updating a user's profile, linked to the 'ProfileController@update' method
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route for deleting a user's profile, linked to the 'ProfileController@destroy' method
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/admin/devices', AdminDeviceController::class)->middleware(['auth'])->names('admin.devices');
Route::resource('/user/devices', UserDeviceController::class)->middleware(['auth'])->names('user.devices')->only(['index', 'show']);

Route::resource('admin/manufacturers', AdminManufacturerController::class)->middleware(['auth'])->names('admin.manufacturers');
Route::resource('user/manufacturers', UserManufacturerController::class)->middleware(['auth'])->names('user.manufacturers')->only(['index', 'show']);

// Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
// Include routes defined in the 'auth.php' file, which handles authentication routes
require __DIR__.'/auth.php';
