<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
     public function UserRegistration(Request $request){
            // Validate the request
           
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);
         
        
      $user=  User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password']
        ]);
        return response()->json([
            'status'=>"sucess",
            'user'=>$user
        ]);
    }
    public function UserLogin(Request $request){
       
      // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ]);

        
         
              // Find the user by email
           $user = User::where('email', $request->input('email'))->first();
            if($user && Hash::check($request->input('password'),$user->password)){
                //password matches ,create token
                $token = $user->createToken('authToken')->plainTextToken;
                //return the token with successful message
                return response()->json([
                    'message'=>'Login Successful',
                    'token'=>$token
                ],200);
            }
       
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        
    }

}
