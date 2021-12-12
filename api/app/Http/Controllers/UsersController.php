<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Requests;
use Exception;

class UsersController extends Controller {
    public function createUser(Request $request){
        $this->validate($request, [
            'autoliv_id' => 'required',
            'password' => 'required'
        ]);
        try {
            $check = User::where('autoliv_id', '=', $request['autoliv_id'])->get();
            if($check->isEmpty()){
                $division = substr($request['autoliv_id'], 0, 3);
                $l2l_activeUser = $this->checkL2LUser($request['autoliv_id']);
                if($l2l_activeUser){
                    $insert = new User();
                    $insert->autoliv_id = $request['autoliv_id'];
                    $insert->division = $division;
                    $insert->password = hash('sha256', $request['password']);
                    if($insert->save()){
                        return response()->json(array('success' => true), 200);
                    }else{
                        return response()->json(array('success' => false), 200);
                    }
                }else{
                    return response()->json(array('success' => false, 'error' => 'user_inactive'), 200);
                }
            }
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function loginUser(Request $request){
        $this->validate($request, [
            'autoliv_id' => 'required',
            'password' => 'required'
        ]);

        $l2lUser = $this->checkL2LUser($request['autoliv_id']);
        if($l2lUser){
            $password = hash('sha256', $request['password']);
            $user = User::where('autoliv_id', '=', $request['autoliv_id'])->get()->makeVisible(['password']);
            if(!$user->isEmpty()){
                if($password === $user[0]['password']){
                    $division = $user[0]['division'];
                    return response()->json(array('success' => true, 'division' => $division, 'id' => $user[0]['id']), 200);
                }else{
                    return response()->json(array('success' => false, 'error' => 'login_failed'), 200);
                }
            }else{
                return response()->json(array('success' => false, 'error' => 'no_user'), 200);
            }
        }else{
            return response()->json(array('success' => false, 'error' => 'no_user'), 200);
        }
    }

    private function checkL2LUser($id){
        $l2l_url = "https://autoliv-eu2.leading2lean.com/api/1.0/users/";
        $l2l_auth = "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh";

        $url = $l2l_url . "?auth=$l2l_auth&site=15&loginid=$id&active=true";
        $request = Requests::get($url);
        $response = json_decode($request->body, true);
        if($response['success']){
            if(count($response['data']) > 0){
                return true;
            }else{
                return false;
            }
        }
    }
}