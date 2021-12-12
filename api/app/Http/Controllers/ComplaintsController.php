<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Exception;

class ComplaintsController extends Controller {
    public function addComplaint(Request $request){
        $this->validate($request, [
            'division' => 'required',
            'user_id' => 'required',
            'route_id' => 'required',
            'complaint' => 'required',
            'title' => 'required',
        ]);

        try {
            $insert = new Complaints();
            $insert->division = $request['division'];
            $insert->user_id = $request['user_id'];
            $insert->route_id = $request['route_id'];
            $insert->complaint = $request['complaint'];
            $insert->title = $request['title'];
            if($insert->save()){
                return response()->json(array('success' => true), 200);
            }else{
                return response()->json(array('success' => false), 200);
            }
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}