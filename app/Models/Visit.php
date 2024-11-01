<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
