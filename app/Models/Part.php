<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'oem',
        'part_url',
        'admin_rec',
        'device_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }


}
