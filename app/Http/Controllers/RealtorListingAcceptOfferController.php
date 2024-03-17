<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        // accept selected offer
        $offer->update([
            'accepted_at' => now(),
        ]);

        // reject all other offers
        $offer->listing->offers()->except($offer)->update([
            'rejected_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with(
            'success',
            "Offer #{$offer->id} was accepted, and all other offers were rejected."
        );
    }
}
