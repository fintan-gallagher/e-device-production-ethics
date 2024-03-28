<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
    ];
    //returns the manufacturer's devices
    // eg. $manufacturer->devices
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
