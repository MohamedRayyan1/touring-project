<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    function register(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12',
      ]);

          $user = User::create([
              'password' => bcrypt($validate['password']),
              'email' => $validate['email'],
          ]);

         $token =JWTAuth::fromUser($user);
          $access['email'] = $user->email; //
          $access['token'] = $token; //
          return response()->json($access,200);

          return response()->json(['message error'=>'some things went wrong']);
      }


      public function login(Request $request) {
        $credentials = ['email'=>$request->email,'password'=>$request->password];
            if(auth()->attempt($credentials )){
                $user = auth()->user();
                $token =JWTAuth::fromUser($user);
                $access['id'] =   $user->id;
                $access['token'] = $token; //
                return response()->json([
                    'message:'=>'login successfully',
                    'your account is:'=> $access
                ]);
            }

            return response()->json('the user is not exists!');
}
}
