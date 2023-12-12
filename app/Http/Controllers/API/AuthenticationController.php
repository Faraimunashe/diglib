<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed']
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            $response = [
                'message' => 'Validation error',
                'status' => 'ERROR',
                'errors' => $errors->all()
            ];

            return response()->json($response, 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //$token = $user->createToken('equilibtoken')->plainTextToken;

        $response = [
            'message' => 'Successfully added new user',
            'status' => 'SUCCESS',
            'data' => [
                'user' => $user,
            ]
            //'token' => $token
        ];

        return response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        $response = [
            'message' => 'logged out',
            'status' => 'SUCCESS'
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            $response = [
                'message' => 'Validation error',
                'status' => 'ERROR',
                'errors' => $errors->all()
            ];

            return response()->json($response, 400);
        }

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => 'Wrong credentials',
                'status' => 'ERROR',
            ], 401);
        }

        $token = $user->createToken('diglibapitokenkey')->plainTextToken;

        $response = [
            'message' => 'Successfully logged in',
            'status' => 'SUCCESS',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ];

        return response()->json($response, 200);
    }
}
