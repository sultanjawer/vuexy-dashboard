<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use Livewire\Component;

class OfferView extends Component
{

    public $offer;
    public $real_estate;
    public $offer_id;
    public $last_update_time;

    public function mount($offer_id)
    {
        $this->offer_id = $offer_id;
        $this->offer = Offer::find($offer_id);
        $this->real_estate = $this->offer->realEstate;
    }

    public function render()
    {
        return view('livewire.offer-view');
    }


    public function getLastUpateTime()
    {
        if ($this->offer) {
            if ($this->offer->updated_at) {
                $last_update = $this->offer->updated_at->toDateTimeString();
                $time_now = now();

                $datetime1 = strtotime($last_update);
                $datetime2 = strtotime($time_now);

                $secs = $datetime2 - $datetime1; // == <seconds between the two times>
                $min = $secs / 60;
                $hour = $secs / 3600;
                $days = $secs / 86400;


                if ($days > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($days, 0) . ' يوم';
                    return true;
                }

                if ($hour > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($hour, 0) . ' ساعة';
                    return true;
                }

                if ($min > 0.99) {
                    $this->last_update_time = 'اخر تحديث منذ ' . round($min, 0)  . ' دقيقة';
                    return true;
                }

                $this->last_update_time = 'اخر تحديث منذ ' . $secs . ' ثواني';
                return true;
            }
        }
    }
}
