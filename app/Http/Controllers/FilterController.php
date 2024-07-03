<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\filterData;
use App\Models\parkingSpots;

class FilterController extends Controller
{

    public function filterData(Request $request){

        // Start with a base query
        $query = parkingSpots::query();

        // Filter by location if provided
        // if ($request->has('location')) {
        //     $query->where('location', $request->location);
        // }

        // Filter by capacity if provided
        if ($request->has('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        // Filter by price_per_hour if provided
        if ($request->has('price_per_hour')) {
            $query->where('price_per_hour', '<=', $request->price_per_hour);
        }

        // Execute the query
        $parkingSpots = $query->get();

        // Return the filtered data as JSON
        return response()->json([
            'parking_spots' => $parkingSpots
        ]);

    }
}
