<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Student;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request) {
       return User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

    }

    public function register_student(Request $request) {

        // Check User ID
        if (!$student = Student::find($request->input('student_id'))) {
            return [
                'message' => 'User not found'
            ]; 
        };

        // Check if user is Registered 
        if ($student->user_id) {
            return [
                "message" => "User ID already registered!"
            ];
        }
        
        // Check Firstname and Lastname
        if (!($request->input('firstname') == $student->firstname && $request->input('lastname') == $student->lastname)) {

            return [
                'message' => 'User not found'
            ]; 
        }

        return $student;
    }


    public function login(Request $request) {
        if(!Auth::attempt($request->only('username', 'password'))) {
            return response([
                'message'=> 'Invalid credentials',
            ],  Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return response([
            'message'=>'Success Login'
        ])->withCookie($cookie);

    }

    public function logout(Request $request) {
        $cookie = Cookie::forget('jwt');

        return response([
            'message'=> 'Logged Out'
        ])->withCookie($cookie);
    }

    public function user() {
        return Auth::user();
    }
}
