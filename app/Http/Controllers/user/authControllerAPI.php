<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class authControllerAPI extends Controller
{
    public function alluser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'nullable|string|max:255',
        ]);

        $validated['role'] = 'user';

        $donation = User::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Account user created successfully',
        ], 201);
    }

    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'nullable|string|max:255',
        ]);

        $validated['role'] = 'user';

        $donation = User::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Account user created successfully',
        ], 201);
    }
    
    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password',
            ], 401);
        }

        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }

    public function signout(Request $request)
    {
        dd($request);
        $api_token = $request['remember_token'];
        
        $user = User::where('remember_token', $api_token)->first();

        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful',
        ], 200);
    }
}
