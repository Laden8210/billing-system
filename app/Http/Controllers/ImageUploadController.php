<?php

namespace App\Http\Controllers;

use App\Models\Remittance;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employee_id' => 'required|numeric',
            'area_id' => 'required|numeric',
        ]);

        if ($request->file('image')) {
            // Define the path where the image will be stored in the public directory
            $imagePath = 'images'; // You can change this to your desired folder structure
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension(); // Generate a unique name

            // Move the uploaded image to the public/images directory
            $request->file('image')->move(public_path($imagePath), $imageName);

            // Create a new remittance record
            Remittance::create([
                'rm_amount' => $request->amount,
                'rm_date' => now(),
                'rm_image' => $imagePath . '/' . $imageName, // Store the path for future reference
                'employee_id' => $request->employee_id,
                'subscriptionarea_id' => $request->area_id,
            ]);

            return response()->json(['url' => asset($imagePath . '/' . $imageName)], 200);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }
}
