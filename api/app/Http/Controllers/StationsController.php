<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stations;
use App\Models\StationSchedule;
use Exception;

class StationsController extends Controller {
    public function addStations(Request $request){
        $this->validate($request, [
            'route_id' => 'required',
            'station' => 'required',
            'description' => 'required',
        ]);

        try {
            //$check = Stations::where('station', '=', $request['station'])->get();
            //if($check->isEmpty()){
                $insert = new Stations();
                $insert->route_id = $request['route_id'];
                $insert->station = $request['station'];
                $insert->description = $request['description'];
                if($insert->save()){
                    return response()->json(array('success' => true, 'station' => $insert), 200);
                }else{
                    return response()->json(array('success' => false), 200);
                }
            //}
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function fetchStations(Request $request){
        $this->validate($request, [
            'route_id' => 'required'
        ]);

        try {
            $station = Stations::where('route_id', '=', $request['route_id'])->get();
            return response()->json(array('success' => true, 'stations' => $station), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function fetchStationSchedule(Request $request){
        $this->validate($request, [
            'station_id' => 'required'
        ]);

        try {
            $schedule = StationSchedule::where('station_id', '=', $request['station_id'])->get();
            return response()->json(array('success' => true, 'schedule' => $schedule), 200);
        } catch (Exception $e) {
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function addStationSchedule(Request $request){
        $this->validate($request, [
            'station_id' => 'required',
            'shift' => 'required',
            'type' => 'required',
        ]);

        if($request['type'] === "tur"){
            StationSchedule::updateOrCreate(
                ['station_id' => $request['station_id'], 'shift' => $request['shift']],
                ['tur' => $request['tur']]
            );
            return response()->json(array('success' => true), 200);
        }else if($request['type'] === "retur"){
            StationSchedule::updateOrCreate(
                ['station_id' => $request['station_id'], 'shift' => $request['shift']],
                ['retur' => $request['retur']]
            );
            return response()->json(array('success' => true), 200);
        }
    }

    public function deleteStation(Request $request){
        $this->validate($request, [
            'station_id' => 'required'
        ]);

        try {
            Stations::where('id', '=', $request['station_id'])->delete();
            StationSchedule::where('station_id', '=', $request['station_id'])->delete();
            return response()->json(array('success' => true), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function editStation(Request $request){
        $this->validate($request, [
            'station_id' => 'required',
            'value' => 'required'
        ]);

        try {
            Stations::where('id', '=', $request['station_id'])->update(['station' => $request['value']]);
            return response()->json(array('success' => true), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}