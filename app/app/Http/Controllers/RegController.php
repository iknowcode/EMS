<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Input;
use App\Models\User;

class RegController extends Controller
{
public function __construct(){

}

public function getFormData(Request $req){
    $req->validate([
        'mobile' => 'required|regex:/^(\+\d{1,3}[-\s]?)?\d{10}$/'
    ]);

    $user = new User;
    try{
        
        $user->first_name = $req->first_name;
        $user->last_name  = $req->last_name;
        $user->password   = $req->pass;
        $user->phone_number = $req->mobile;
        $user->comm_address = $req->address;
        $user->gender = $req->gender;
        $user->city = $req->city;
        $user->DOB = $req->dob;
        $user->type_of_user = 'Normal';
        $user->save();
    }
    catch( Exception $e){
        // log exception($e)
            return redirect()->back()->with('message', 'Issues with Registration');
    }

    return redirect()->back()->with('message', 'Registration Successful');
}

}
