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

    $user = new User;
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

    return $req.'Successful';
}

}
