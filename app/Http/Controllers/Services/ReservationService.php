<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OfferEditors;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationService extends Controller
{
    public function store($data, $offer)
    {
        $dates = explode(" to ", $data['date']);
        $date_from = $dates[0];
        $date_to = $dates[1];
        $user = auth()->user();
        $customer = Customer::find($data['customer_id']);

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'customer_id' => $customer->id,
            'offer_id' => $offer->id,
            'offer_code' => $offer->offer_code,
            'customer_name' => $customer->name,
            'price' => $data['price'],
            'status' => 1,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'note' => $data['reservation_notes'],
        ]);


        if ($user->user_type == 'admin' || $user->user_type == 'superadmin') {
            $link_admin =  route('panel.user', $user->id);
            $admin = "<a href='$link_admin'>$user->name</a>";
            $note = "قام المدير $admin بحجز العرض";
        }

        if ($user->user_type == 'marketer') {
            $marketer_name = getUserName($user->id);
            $link_ma = route('panel.user', $user->id);
            $marketer = "<a href='$link_ma'> $marketer_name</a>";
            $note = "قام المسوق $marketer بحجز العرض";
        }

        OfferEditors::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'note' => $note,
            'action' => 'book',
        ]);

        return $reservation;
    }

    public function update($reservation, $data)
    {
        $reservation->update([
            'customer_name' => $data['customer_name'],
            'price' => $data['price'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
        ]);

        return true;
    }
}
