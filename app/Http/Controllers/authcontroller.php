<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;        
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authcontroller extends Controller
{
   public function register(Request $request){
    $validator = Validator::make($request->all(), [
        'name'=>'required',
        'email'=>'required_without:phone|email|nullable|unique:users',
        'phone'=>'required_without:email|nullable|unique:users',
        'password'=>'required|min:6',
        'role'=>'required|in:admin,user',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->role = $request->role;   
    $user->save();

    return redirect()->route('login')->with('success', 'Register success, now login');
   }

   public function login(Request $request){
    $validator = Validator::make($request->all(), [
        'email'=>'nullable|required_without:phone|email',
        'phone'=>'nullable|required_without:email',
        'password'=>'required|min:6'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);    }

    $credentials = $request->only('email', 'phone', 'password');
    if (Auth::attempt($credentials)) {
       $request->session()->regenerate();
       return redirect()->route('welcome');
        
    } 
    else {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }

}

   public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}

}
