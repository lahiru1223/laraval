<?php
namespace App\Services;
use App\Models\parking;

class ParkingService{

    public function newParking($request){
        $items = new parking();
        $items->vehicleNum = $request->vehicleNum;
        $items->parkingType = $request->parkingType;
        $items->location = $request->location;
        $items->start = now();
        $items->save();
    }

    public function endParking($request){
        $items = parking::findorfail($request->id);
        $items->end = now();
        $items->update();
    }

}