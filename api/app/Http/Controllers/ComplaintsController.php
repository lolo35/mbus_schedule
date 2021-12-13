<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;
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

    public function getComplaints(Request $request){
        $this->validate($request, [
            'division' => 'required'
        ]);

        try {
            //$data = Complaints::where('division', '=', $request['division'])->orderBy('created_at', 'desc')->get();
            $data = DB::table('complaints')
                ->join('users', 'complaints.user_id', '=', 'users.id')
                ->join('routes', 'complaints.route_id', '=', 'routes.id')
                ->select('complaints.*', 'users.autoliv_id', 'routes.route')
                ->where('complaints.division', '=', $request['division'])
                ->orderBy('complaints.created_at', 'desc')
                ->get();
            return response()->json(array('success' => true, 'complaints' => $data), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}