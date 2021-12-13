<?php
namespace App\Http\Controllers;
use App\Models\Sugestions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SugestionsController extends Controller {
    public function addSugestion(Request $request){
        $this->validate($request,
            [
                'division' => 'required',
                'user_id' => 'required',
                'route_id' => 'required',
                'title' => 'required',
                'sugestion' => 'required'
            ]
        );

        try {
            $insert = new Sugestions();
            $insert->division = $request['division'];
            $insert->user_id = $request['user_id'];
            $insert->route_id = $request['route_id'];
            $insert->title = $request['title'];
            $insert->sugestion = $request['sugestion'];
            if($insert->save()){
                return response()->json(array('success' => true), 200);
            }else{
                return response()->json(array('succeess' => false), 200);
            }
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function getSugestions(Request $request){
        $this->validate($request, [
            'division' => 'required'
        ]);

        try {
            $data = DB::table('sugestions')
                ->join('users', 'users.id', '=', 'sugestions.user_id')
                ->join('routes', 'routes.id', '=', 'sugestions.route_id')
                ->select('sugestions.*', 'users.autoliv_id', 'routes.route')
                ->orderBy('sugestions.created_at', 'desc')
                ->get();
            return response()->json(array('success' => true, 'sugestions' => $data), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}