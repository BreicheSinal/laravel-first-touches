<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTAuthController extends Controller
{
     // User registration
     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
         ]);
 
         if($validator->fails()){
             return response()->json($validator->errors()->toJson(), 400);
         }
 
         $user = User::create([
             'name' => $request->get('name'),
             'email' => $request->get('email'),
             'password' => Hash::make($request->get('password')),
         ]);
 
         $token = JWTAuth::fromUser($user);
 
         return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
            'token' => $token
        ], 201);
     }
 
     // User login
     public function login(Request $request)
     {
         $credentials = $request->only('email', 'password');
 
         try {
             if (! $token = JWTAuth::attempt($credentials)) {
                 return response()->json(['error' => 'Invalid credentials'], 401);
             }
 
             $user = JWTAuth::user();
             $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);
 
             return response()->json(compact('token'));
         } catch (JWTException $e) {
             return response()->json(['error' => 'Could not create token'], 500);
         }
     }
 
     public function getUser()
     {
         try {
             if (! $user = JWTAuth::parseToken()->authenticate()) {
                 return response()->json(['error' => 'User not found'], 404);
             }
         } catch (JWTException $e) {
             return response()->json(['error' => 'Invalid token'], 400);
         }
 
         return response()->json(compact('user'));
     }
}