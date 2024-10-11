<?php

namespace App\Http\Controllers;

use App\Models\Remittance;
use Illuminate\Http\Request;
class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'amount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'employee_id' => 'required|numeric',
            'area_id' => 'required|numeric',
        ]);

        // Initialize variables
        $imagePath = null; // Default to null if no image is provided

        // Handle image upload if an image is present
        if ($request->hasFile('image')) {
            try {
                $imagePath = 'images'; // Define folder for storing images
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension(); // Generate a unique name

                // Move the image to the public/images directory
                $request->file('image')->move(public_path($imagePath), $imageName);

                // Set the full path for saving into the database
                $imagePath = $imagePath . '/' . $imageName;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Image upload failed: ' . $e->getMessage()], 500);
            }
        }

        // Create the remittance record in the database
        $rem = Remittance::create([
            'rm_amount' => $request->amount,
            'rm_date' => now(),
            'rm_image' => $imagePath, // Can be null if no image was uploaded
            'employee_id' => $request->employee_id,
            'subscriptionarea_id' => $request->area_id,
        ]);

        // Return a JSON response with the URL of the uploaded image (if any)
        return response()->json([
            'url' => $imagePath ? asset($imagePath) : null, // Return null if no image
            'rem' => $rem
        ], 200);
    }
}

