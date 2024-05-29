<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\parking;
use App\Models\parkingSpots;
use Illuminate\Http\Request;
use RuntimeException;
use App\Services\ParkingService;

class ParkingController extends Controller
{

    public function park(Request $request){
        
        $saveData = (new ParkingService)->newParking($request);
       // throw new RuntimeException('Test Error');
        return response()->json(['Status'=>'Successful']);
    }

    public function exitPark(Request $request){

        $saveData = (new ParkingService)->endParking($request);
        return response()->json(['Status'=>'Update Successful']);        

    }

    public function deletePark(Request $request){
        $items = parking::findorfail($request->id)->delete();
        return response()->json(['Status'=>'Delete Successful']);  
    }

    public function viewPark(Request $request){
        $items = parking::all();
        return response()->json($items);
    }

    public function spots(Request $request){
        $items = parkingSpots::all();
        return response()->json($items);        
    }    
}
