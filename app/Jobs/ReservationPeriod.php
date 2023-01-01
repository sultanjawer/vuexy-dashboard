<?php

namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReservationPeriod implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $reservation_id)
    {
        $this->reservation_id = $reservation_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reservation = Reservation::find($this->reservation_id);
        $reservation->update(['status' => 2]);
        $reservation->offer->realEstate->update(['property_status_id' => 1]);
    }
}
