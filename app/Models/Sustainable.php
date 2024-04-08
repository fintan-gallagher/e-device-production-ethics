<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class Sustainable extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'comments',
        'manufacturer_id'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }


}
