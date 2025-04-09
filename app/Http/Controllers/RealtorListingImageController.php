<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

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

            try {
                foreach ($request->file('images') as $file) {
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                    $path = Storage::disk('s3')->putFileAs(
                        'images',
                        $file,
                        $filename,
                        ['visibility' => 'public']
                    );

                    if (!$path) {
                        throw new \Exception('Failed to upload image to S3.');
                    }

                    $listing->images()->save(new ListingImage([
                        'filename' => $path,
                    ]));
                }

                return Redirect::back()
                    ->with('success', 'Images uploaded successfully!');
            } catch (\Exception $e) {
                return Redirect::back()
                    ->withErrors(['upload_error' => 'Error uploading images: ' . $e->getMessage()])
                    ->withInput();
            }
        }

        return Redirect::back()
            ->with('info', 'No images were uploaded.');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('s3')->delete($image->filename);
        $image->delete();

        return Redirect::back()
            ->with('success', 'Image deleted successfully!');
    }
}
