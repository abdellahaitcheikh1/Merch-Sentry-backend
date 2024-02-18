<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function login(Request $request){
        // $email=$request->CompteEmail;
        // $password=$request->Password;
        // $Account = ["CompteEmail"=>$email,"password"=>$Password];
        // if(Auth::attempt($Account)){
        //     dd("good");
        // }
        //     return back()->with('message',"Il n'y a pas de compte avec ces informations");






        $email=$request->CompteEmail;
        $Password=$request->Password;
        $Accounts=DB::select('select * from utilisateurs where CompteEmail = ? and Password=?', [$email,$Password]);
        foreach($Accounts as $Account)
        if($Account->IDRole==2){
                return response()->json("commercial", 200);
            }elseif($Account->IDRole==3){
                return response()->json("magasin", 200);

            }elseif($Account->IDRole==4){
                return response()->json("comptoire", 200);

            }elseif($Account->IDRole==5){
                return response()->json("dev", 200);

            }else{
                return response()->json("superAdmin", 200);

            }
            return response()->json("Il n'y a pas de compte avec ces informations", 200);


    }
}
