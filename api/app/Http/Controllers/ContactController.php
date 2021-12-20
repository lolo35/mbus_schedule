<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Exception;

class ContactController extends Controller {
    public function getContact(Request $request){
        $this->validate($request, [
            'division' => 'required'
        ]);

        try {
            $data = Contact::where('divizion', '=', $request['division'])->get();
            return response()->json(array('success' => true, 'data' => $data), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}