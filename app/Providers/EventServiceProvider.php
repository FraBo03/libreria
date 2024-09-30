<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\LoanUpdated;
use App\Listeners\UpdateBookAvailability;

class EventServiceProvider extends ServiceProvider
{
    /**
     * La mappa degli eventi per i listener.
     *
     * @var array
     */
    protected $listen = [
        LoanUpdated::class => [
            UpdateBookAvailability::class,
        ],
    ];

    /**
     * Registra qualsiasi evento per la tua applicazione.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
