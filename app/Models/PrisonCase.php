<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class PrisonCase extends Model
{
    use HasFactory;


    protected $guarded = ['id'];


    // public function prisoners()
    // {
    //     return $this->belongsToMany(Prisoner::class);
    // }

       // Define the relationship to Prisoner
       public function prisoners()
       {
           return $this->belongsToMany(Prisoner::class, 'prison_case_prisoner', 'prison_case_id', 'prisoner_id');
       }

       public function location()
       {
           return $this->belongsTo(Location::class);
       }

}
