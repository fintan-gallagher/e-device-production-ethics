<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Label;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'genre',
        'isbn',
        'release_year',
        'description',
        'record_cover',
        'label_id'
    ];

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}
