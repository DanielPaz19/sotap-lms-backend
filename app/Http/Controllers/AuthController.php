<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\TeacherCollection;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
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
        if (!$student = Student::find($request->input('user_id'))) {
            return response()->json([
                'message' => 'User information did not match.'
            ], 422); 
        };

        // Check if user is Registered 
        if ($student->user_id) {
            return response()->json([
                "message" => "User ID already registered!"
            ], 422);
        }
        
        // Check Firstname and Lastname
        if (!($request->input('firstname') == $student->firstname && $request->input('lastname') == $student->lastname)) {

            return response()->json([
                'message' => 'User information did not match.'
            ], 422); 
        }

        if ($request->input('username') !=  "") {
            // Check Username
            if (User::all()->where('username','=',$request->input('username'))->count() > 0){
                return response()->json([
                    'message' => 'Username not available. Try again.'
                ], 422);
            };
        } else {
            return response()->json([
                'message' => 'Enter Username and Password'
            ], Response::HTTP_ACCEPTED);
        }

        // Register User
        $student = Student::find($request->input('user_id'));

        $data = $student->user()->create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 3
        ]);

        
        $student->user()->associate($data);

        if(!$student->save()) {
            return response()->json([
                "message" => "Something Went Wrong!"
            ], 422);
        } else { 
            return response()->json([
                "message" => "Registered Successfully"
            ], Response::HTTP_CREATED);
        };
    }

    
    public function register_teacher(Request $request) {
        // Check User ID
        if (!$teacher = Teacher::find($request->input('user_id'))) {
            return response()->json([
                'message' => 'User information did not match.'
            ], 422); 
        };

        // Check if user is Registered 
        if ($teacher->user_id) {
            return response()->json([
                "message" => "User ID already registered!"
            ], 422);
        }
        
        // Check Firstname and Lastname
        if (!($request->input('firstname') == $teacher->firstname && $request->input('lastname') == $teacher->lastname)) {

            return response()->json([
                'message' => 'User information did not match.'
            ], 422); 
        }

        if ($request->input('username') !=  "") {
            // Check Username
            if (User::all()->where('username','=',$request->input('username'))->count() > 0){
                return response()->json([
                    'message' => 'Username not available. Try again.'
                ], 422);
            };
        } else {
            return response()->json([
                'message' => 'Enter Username and Password'
            ], Response::HTTP_ACCEPTED);
        }


        // Register User
        $teacher = Teacher::find($request->input('user_id'));

        $data = $teacher->user()->create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 2
        ]);

        
        $teacher->user()->associate($data);

        if(!$teacher->save()) {
            return response()->json([
                "message" => "Something Went Wrong!"
            ], 422);
        } else { 
            return response()->json([
                "message" => "Registered Successfully"
            ], Response::HTTP_CREATED);
        };
    }


    public function login(Request $request) {
        if(!Auth::attempt($request->only('username', 'password', 'role'))) {
            return response([
                'message'=> 'Incorrect Username or Password',
            ],  Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24,null,null,null,true,false,"none");

        // admin Role
        if ($user->role == 1) {
            $data = new UserCollection(User::where('id', $user->id)->get());
        }

        // teacher role
        if ($user->role == 2) {
            $data =  new TeacherCollection(Teacher::where('user_id', $user->id)->get());
        }

        // student role
        if ($user->role == 3) {
            $data =  new StudentCollection(Student::where('user_id', $user->id)->get());
        }


        return response($data, Response::HTTP_OK)->withCookie($cookie);

    }

    public function logout(Request $request) {
        $cookie = Cookie::forget('jwt');

        return response([
            'message'=> 'Logged Out'
        ])->withCookie($cookie);
    }

    public function user() {
        $user = Auth::user();

        // admin Role
        if ($user->role == 1) {
            $data = new UserCollection(User::where('id', $user->id)->get());
        }

        // teacher role
        if ($user->role == 2) {
            $data =  new TeacherCollection(Teacher::where('user_id', $user->id)->get());
        }

        // student role
        if ($user->role == 3) {
            $data =  new StudentCollection(Student::where('user_id', $user->id)->get());
        }


        return response($data, Response::HTTP_OK);
    }
}
