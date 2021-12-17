<?php
namespace App\Http\Controllers;
use App\Models\Routes;
use Illuminate\Http\Request;
use Exception;

class RoutesController extends Controller {
    public function addRoute(Request $request){
        $this->validate($request, [
            'route' => 'required',
            'description' => 'required',
            'division' => 'required',
        ]);

        try {
            $check = Routes::where('route', '=', $request['route'])->get();
            if($check->isEmpty()){
                $insert = new Routes();
                $insert->route = $request['route'];
                $insert->description = $request['description'];
                $insert->division = $request['division'];
                if($insert->save()){
                    return response()->json(array('success' => true, 'route' => $insert), 200);
                }else{
                    return response()->json(array('success' => false), 200);
                }
            }
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function getRoutes(Request $request){
        $this->validate($request, [
            'division' => 'required'
        ]);

        try {
            $data = Routes::where('division', '=', $request['division'])->get();
            return response()->json(array('success' => true, 'data' => $data), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function getRoutesForUser(Request $request){
        $this->validate($request, [
            'user' => 'required'
        ]);

        try {
            $division = substr($request['user'], 0, 3);
            return response()->json(array('success' => true, 'data' => $division), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function editRouteName(Request $request){
        $this->validate($request, [
            'route' => 'required',
            'route_id' => 'required'
        ]);

        try {
            Routes::where('id', '=', $request['route_id'])->update(['route' => $request['route']]);
            return response()->json(array('success' => true), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function editRouteDescription(Request $request){
        $this->validate($request, [
            'description' => 'required',
            'route_id' => 'required'
        ]);

        try {
            Routes::where('id', '=', $request['route_id'])->update(['description' => $request['description']]);
            return response()->json(array('success' => true), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function deleteRoute(Request $request){
        $this->validate($request, [
            'route_id' => 'required',
        ]);

        try {
            Routes::where('id', '=', $request['route_id'])->delete();
            return response()->json(array('success' => true), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}