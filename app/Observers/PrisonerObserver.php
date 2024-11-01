<?php

namespace App\Observers;

use App\Models\Historie;
use App\Models\Prisoner;
use App\Models\Log;

class PrisonerObserver
{
    /**
     * Handle the Prisoner "created" event.
     */
    public function created(Prisoner $prisoner): void
    {
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'created',
            'changes' => $prisoner->getAttributes(),
        ]);
    }

    /**
     * Handle the Prisoner "updated" event.
     */
    public function updated(Prisoner $prisoner): void
    {
        // Get the changes made to the prisoner
        $changes = $prisoner->getChanges();

        // Log the changes
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'updated',
            'changes' => $changes,
        ]);
    }

    /**
     * Handle the Prisoner "deleted" event.
     */
    public function deleted(Prisoner $prisoner): void
    {
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'deleted',
            'changes' => $prisoner->getAttributes(),
        ]);
    }

    /**
     * Handle the Prisoner "restored" event.
     */
    public function restored(Prisoner $prisoner): void
    {
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'restored',
            'changes' => $prisoner->getAttributes(),
        ]);
    }

    /**
     * Handle the Prisoner "force deleted" event.
     */
    public function forceDeleted(Prisoner $prisoner): void
    {
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'forceDeleted',
            'changes' => $prisoner->getAttributes(),
        ]);
    }

    public function movedToHistorie(Prisoner $prisoner): void
    {


      // Log the action
        Log::create([
            'model_type' => Prisoner::class,
            'model_id' => $prisoner->id,
            'action' => 'movedToHistorie',
            'changes' => [
                'prisoner_id' => $prisoner->id,
                'name' => $prisoner->name,
                'arrestatiereden' => $prisoner->arrestatiereden,
                'BSN_nummer' => $prisoner->BSN_nummer,
                'adres' => $prisoner->adres,
                'woonplaats' => $prisoner->woonplaats,
                'datumarrestatie' => $prisoner->datumarrestatie,
                'zaak_id' => $prisoner->zaak_id,
                'cel_id' => $prisoner->cel_id,
                'insluitingsdatum' => $prisoner->insluitingsdatum,
                'uitsluitingsdatum' => $prisoner->uitsluitingsdatum,
                'maatschappelijke_aantekeningen' => $prisoner->maatschappelijke_aantekeningen,
                'location_id' => $prisoner->location_id,
            ],
        ]);

    }
}
