<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:jpg,jpeg,png,webp|max:5000',
            ], [
                'images.*.mimes' => 'The image must be a file of type: jpg, jpeg, png, webp.',
                'images.*.max' => 'The image may not be greater than 5MB.',
            ]);

            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $listing->images()->save(new ListingImage([
                    'filename' => $path,
                ]));
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Images uploaded successfully!');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()
            ->back()
            ->with('success', 'Image deleted successfully!');
    }
}
