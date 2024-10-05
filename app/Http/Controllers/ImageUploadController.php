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
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');


            Remittance::create([

                'rm_amount' => $request->amount,
                'rm_date' => now(),
                'rm_image' => $path,
            ]);
            return response()->json(['url' => asset('storage/' . $path)], 200);
        }

        return response()->json(['error' => 'Image upload failed'], 400);
    }
}
