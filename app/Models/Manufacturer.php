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
        'lng',
        'lat',
        'email',
        'ethics_score',
        'bio',
        'manufacturer_img'
    ];
    //returns the manufacturer's devices
    // eg. $manufacturer->devices
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function sustainable()
    {
        return $this->hasOne(Sustainable::class);
    }
}
