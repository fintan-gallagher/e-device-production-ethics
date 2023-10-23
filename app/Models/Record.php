<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist',
        'genre',
        'isbn',
        'year',
        'description',
        'record_cover',
    ];
}

// $record = new Record();
// $record->title = 'Sample Record Title';
// $record->description = "This is a sample record description";
// $record->save();
