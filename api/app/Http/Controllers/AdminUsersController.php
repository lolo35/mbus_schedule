<?php
namespace App\Http\Controllers;
use App\Models\AdminUsers;
use Illuminate\Http\Request;
use Exception;

class AdminUsersController extends Controller {

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $user = AdminUsers::where('username', '=', $request['username'])->get()->makeVisible(['password']);
            if(!$user->isEmpty()){
                $password = hash('sha256', $request['password']);
                if($password === $user[0]['password']){
                    return response()->json(array('success' => true), 200);
                }else{
                    return response()->json(array('success' => false, 'error' => 'login_failed'), 200);
                }
            }else{
                return response()->json(array('success' => false, 'error' => 'login_failed'), 200);
            }
        } catch (Exception $e) {
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}