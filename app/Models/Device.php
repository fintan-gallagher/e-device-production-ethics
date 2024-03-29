<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'repairability',
        'parts_availability',
        'recycled',
        'release_year',
        'price',
        'device_cover',
        'manufacturer_id'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function repairGuides()
    {
        return $this->hasMany(RepairGuide::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }


}
