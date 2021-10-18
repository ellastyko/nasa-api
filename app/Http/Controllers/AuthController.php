<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\ {
    Validator,
    Hash, 
    Auth,
};
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request) {

        try {

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response([
                    'message' => 'Invalid credentials'
                ], Response::HTTP_UNAUTHORIZED);
            }
            $user = User::find(auth()->user()->id);

            $token = $user->createToken('remember_token')->plainTextToken;

            $user->update(['remember_token' => $token]);

            return response([
                'message' => 'You have logged in',
                'user' => $user,
                'token' => $token          
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ],  Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request) {

        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]); 
        if ($validator->fails()) {
            return Response([
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $validated = $validator->validated();
        // Create user
        try {
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])                  
            ]);
            return response([
                'message' => 'You have registered',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ],  Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request) {

        
        Auth::logout();
        return Response([
            'message' => 'You have logged out!'
        ]);
    }
}
