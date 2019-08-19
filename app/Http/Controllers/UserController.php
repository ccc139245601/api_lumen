<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{


    Public function login(Request $request){

        if ($request->isJson()){
            $data = $request->json()->all();   

            $user = User::where('username',$data['username'])->first();
                        
            if ( $user && Hash::check($data['password'], $user->password)) {
                Return response()->json([$user, 200]);
            }else{
                Return response()->json('No autorizado',401);
            }

        }else{

            Return response()->json('No autorizado',401);    
        }

    }



    Public function index(Request $request){

        if ($request->isJson()){
            Return response()->json([User::all(), 200]);    
        }

        Return response()->json('No autorizado',401);
        
    }


    Public function createUser(Request $request){

        
        if ($request->isJson()){

            $data = $request->json()->all();

            $user = User::create([
                   'name' => $data['name'],
                   'username' => $data['username'],
                   'email' => $data['email'],
                   'password' => Hash::make($data['password']),
                   'api_token' => Hash::make($data['api_token'])
            ]);

            Return response()->json($user, 201);
        }
        
        Return response()->json('No autorizado',401);

        
    }

    

}
