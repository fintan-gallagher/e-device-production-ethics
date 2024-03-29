<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class RepairGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide',
        'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }


}
