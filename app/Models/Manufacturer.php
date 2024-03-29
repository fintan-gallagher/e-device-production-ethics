<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;
use App\Models\Sustainable;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'ethics_score',
        'bio'
    ];
    //returns the manufacturer's devices
    // eg. $manufacturer->devices
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function sustainables()
    {
        return $this->hasMany(Sustainable::class);
    }
}
