<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = ['name'];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
