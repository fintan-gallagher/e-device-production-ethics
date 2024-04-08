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

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($part) {
        // Check if the device has any other parts left
        $hasOtherParts = $part->device->parts()->where('id', '!=', $part->id)->exists();

        // If not, update the part_availability attribute to 'No'
        if (!$hasOtherParts) {
            $part->device->update(['part_availability' => 'No']);
        }
    });
}
}
