<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
