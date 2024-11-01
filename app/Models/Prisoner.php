<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Historie;
use Illuminate\Support\Facades\Storage;

class Prisoner extends Model
{
    use HasFactory;

    protected $guarded = ['name'];

    public function cell()
    {
        return $this->hasOne(Cell::class, 'id', 'cel_id');
    }


    //  public function prisonCases()
    // {
    //     return $this->belongsToMany(PrisonCase::class);
    // }

    // Define the relationship to PrisonCase
    public function prisonCases()
    {
        return $this->belongsToMany(PrisonCase::class, 'prison_case_prisoner', 'prisoner_id', 'prison_case_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

public function moveToHistorie()
{
    $zaakIds = $this->prisonCases()->pluck('prison_case_id')->toArray();

    $pasfotoPath = null;

    if ($this->pasfoto) {
        // Extract the filename from the existing path
        $filename = basename($this->pasfoto);

        // Move the image file to Historie directory
        $newPath = Storage::disk('public')->move('images/prisoners/' . $filename, 'historie/' . $filename);

        // Check if move operation was successful
        if ($newPath) {
            $pasfotoPath = 'historie/' . $filename;
        } else {
            $pasfotoPath = null;
        }
    }
    Historie::create([
        'pasfoto' => $pasfotoPath ?? null,
        'name' => $this->name,
        'arrestatiereden' => $this->arrestatiereden,
        'BSN_nummer' => $this->BSN_nummer,
        'adres' => $this->adres,
        'woonplaats' => $this->woonplaats,
        'datumarrestatie' => $this->datumarrestatie,
        'zaak_id' => json_encode($zaakIds),
        'cel_id' => $this->cel_id,
        'insluitingsdatum' => $this->insluitingsdatum,
        'uitsluitingsdatum' => $this->uitsluitingsdatum,
        'maatschappelijke_aantekeningen' => $this->maatschappelijke_aantekeningen,
        'location_id' => $this->location_id,
    ]);

    $this->delete();
}



}
