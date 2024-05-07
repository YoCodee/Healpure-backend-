<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'data' => $success,
            'message' => 'Your Data Succesfully Created'
        ],200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            return response()->json([
                'success' => true,
                'data' => $success,
                'message' => 'Login SUccesfully'
            ]);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'USer tidak ada'
            ]);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' =>'Logout Succesfully'
        ], 200);
    }
}
