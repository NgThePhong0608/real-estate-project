<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];
        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->withFilter($filters)
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing,
            ]
        );
    }

    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'code' => 'required',
                'city' => 'required',
                'street' => 'required',
                'street_num' => 'required',
                'price' => 'required|integer|min:1000|max:20000000',
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

    public function create()
    {
        // $this->authorize('create');
        return inertia('Realtor/Create');
    }

    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'code' => 'required',
                'city' => 'required',
                'street' => 'required',
                'street_num' => 'required',
                'price' => 'required|integer|min:1000|max:20000000',
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()
            ->with('success', 'Listing was restored!');
    }

    public function forceDelete(Listing $listing)
    {
        $listing->forceDelete();
        return redirect()->back()
            ->with('success', 'Listing was permanently deleted!');
    }
}
