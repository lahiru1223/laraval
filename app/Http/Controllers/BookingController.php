<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function book(Request $request)
    {
        // Log request data for debugging
        Log::info('Booking Request:', $request->all());

        $validator = Validator::make($request->all(), [
            'userId' => 'required|exists:users,id',
            'parkingSpotId' => 'required|exists:parking_spots,id',
            'startTime' => 'required|date|after_or_equal:now',
            'endTime' => 'required|date|after:startTime',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $userId = $request->input('userId');
        $parkingSpotId = $request->input('parkingSpotId');
        $startTime = Carbon::parse($request->input('startTime'))->format('Y-m-d H:i:s');
        $endTime = Carbon::parse($request->input('endTime'))->format('Y-m-d H:i:s');

        // Check for overlapping bookings
        $overlappingBookings = Booking::where('parking_spot_id', $parkingSpotId)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhereRaw('? BETWEEN start_time AND end_time', [$startTime])
                      ->orWhereRaw('? BETWEEN start_time AND end_time', [$endTime]);
            })
            ->exists();

        if ($overlappingBookings) {
            return response()->json(['error' => 'Parking spot is already booked for the specified time range'], 409);
        }

        // Create the booking
        $booking = Booking::create([
            'user_id' => $userId,
            'parking_spot_id' => $parkingSpotId,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return response()->json($booking, 200);
    } 
    
    public function deleteBook(Request $request){
        $items = Booking::findorfail($request->id)->delete();
        return response()->json(['Status'=>'Delete Successful']);  
    }
}
