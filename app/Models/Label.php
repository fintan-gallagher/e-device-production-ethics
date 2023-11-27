<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Record;

class Label extends Model
{
    use HasFactory;

    //returns the label's records
    // eg. $label->records
    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
